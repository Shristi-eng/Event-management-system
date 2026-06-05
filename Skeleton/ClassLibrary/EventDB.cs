using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;

namespace ClassLibrary
{
    /// <summary>
    /// Data-access class for the events table in SQL Server (data layer).
    /// </summary>
    public class EventDB
    {
        private readonly string _connectionString;

        public EventDB()
        {
            _connectionString = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString;
        }

        // ── READ ────────────────────────────────────────────────────────────────

        public List<Event> GetAllEvents()
        {
            var list = new List<Event>();
            using (var conn = new SqlConnection(_connectionString))
            {
                var cmd = new SqlCommand("SELECT * FROM events ORDER BY event_date", conn);
                conn.Open();
                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                        list.Add(MapRow(reader));
                }
            }
            return list;
        }

        public Event GetEventById(int id)
        {
            using (var conn = new SqlConnection(_connectionString))
            {
                var cmd = new SqlCommand("SELECT * FROM events WHERE event_id = @id", conn);
                cmd.Parameters.AddWithValue("@id", id);
                conn.Open();
                using (var reader = cmd.ExecuteReader())
                {
                    if (reader.Read()) return MapRow(reader);
                }
            }
            return null;
        }

        // ── WRITE ───────────────────────────────────────────────────────────────

        public bool InsertEvent(Event ev)
        {
            using (var conn = new SqlConnection(_connectionString))
            {
                var cmd = new SqlCommand(
                    "INSERT INTO events (event_name, location, event_date, event_time, description) " +
                    "VALUES (@name, @location, @date, @time, @desc)", conn);
                AddParams(cmd, ev);
                conn.Open();
                return cmd.ExecuteNonQuery() > 0;
            }
        }

        public bool UpdateEvent(Event ev)
        {
            using (var conn = new SqlConnection(_connectionString))
            {
                var cmd = new SqlCommand(
                    "UPDATE events SET event_name=@name, location=@location, " +
                    "event_date=@date, event_time=@time, description=@desc " +
                    "WHERE event_id=@id", conn);
                AddParams(cmd, ev);
                cmd.Parameters.AddWithValue("@id", ev.EventId);
                conn.Open();
                return cmd.ExecuteNonQuery() > 0;
            }
        }

        public bool DeleteEvent(int id)
        {
            using (var conn = new SqlConnection(_connectionString))
            {
                var cmd = new SqlCommand("DELETE FROM events WHERE event_id = @id", conn);
                cmd.Parameters.AddWithValue("@id", id);
                conn.Open();
                return cmd.ExecuteNonQuery() > 0;
            }
        }

        // ── STATISTICS ──────────────────────────────────────────────────────────

        public int CountEvents()
        {
            return ScalarCount("SELECT COUNT(*) FROM events");
        }

        public int CountRegistrations()
        {
            return ScalarCount("SELECT COUNT(*) FROM registrations");
        }

        public int CountFeedback()
        {
            return ScalarCount("SELECT COUNT(*) FROM feedback");
        }

        public int CountAttendance()
        {
            return ScalarCount("SELECT COUNT(*) FROM attendance");
        }

        // ── HELPERS ─────────────────────────────────────────────────────────────

        private Event MapRow(SqlDataReader r)
        {
            var ev = new Event();
            ev.EventId      = Convert.ToInt32(r["event_id"]);
            ev.EventName    = r["event_name"].ToString();
            ev.Location     = r["location"].ToString();
            ev.EventDate    = Convert.ToDateTime(r["event_date"]);
            ev.EventTime    = r["event_time"].ToString();
            ev.Description  = r["description"].ToString();
            return ev;
        }

        private void AddParams(SqlCommand cmd, Event ev)
        {
            cmd.Parameters.AddWithValue("@name",     ev.EventName);
            cmd.Parameters.AddWithValue("@location", ev.Location);
            cmd.Parameters.AddWithValue("@date",     ev.EventDate.ToString("yyyy-MM-dd"));
            cmd.Parameters.AddWithValue("@time",     ev.EventTime);
            cmd.Parameters.AddWithValue("@desc",     ev.Description);
        }

        private int ScalarCount(string sql)
        {
            using (var conn = new SqlConnection(_connectionString))
            {
                var cmd = new SqlCommand(sql, conn);
                conn.Open();
                return Convert.ToInt32(cmd.ExecuteScalar());
            }
        }
    }
}
