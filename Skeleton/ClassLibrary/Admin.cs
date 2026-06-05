using System;
using System.Configuration;
using System.Data.SqlClient;

namespace ClassLibrary
{
    /// <summary>
    /// Represents an administrator account.
    /// </summary>
    public class Admin
    {
        public int    AdminId  { get; set; }
        public string Username { get; set; }
        public string Password { get; set; }

        /// <summary>
        /// Looks up credentials in SQL Server and returns the Admin object on success, null on failure.
        /// Uses parameterised query to prevent SQL injection.
        /// </summary>
        public static Admin ValidateLogin(string username, string password)
        {
            if (string.IsNullOrWhiteSpace(username) || string.IsNullOrWhiteSpace(password))
                return null;

            string connStr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString;

            using (var conn = new SqlConnection(connStr))
            {
                var cmd = new SqlCommand(
                    "SELECT * FROM admins WHERE username = @username AND password = @password", conn);
                cmd.Parameters.AddWithValue("@username", username.Trim());
                cmd.Parameters.AddWithValue("@password", password.Trim());
                conn.Open();
                using (var reader = cmd.ExecuteReader())
                {
                    if (reader.Read())
                    {
                        return new Admin
                        {
                            AdminId  = Convert.ToInt32(reader["admin_id"]),
                            Username = reader["username"].ToString(),
                            Password = reader["password"].ToString()
                        };
                    }
                }
            }
            return null;
        }
    }
}
