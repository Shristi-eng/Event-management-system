using System;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace AdminSystem
{
    public partial class Attendance : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["AdminUsername"] == null)
                Response.Redirect("AdminLogin.aspx");

            if (!IsPostBack)
                LoadData();
        }

        private void LoadData()
        {
            string connStr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString;
            using (var conn = new SqlConnection(connStr))
            {
                var cmd = new SqlCommand("SELECT * FROM registrations", conn);
                var da  = new SqlDataAdapter(cmd);
                var dt  = new DataTable();
                da.Fill(dt);
                gvAttendance.DataSource = dt;
                gvAttendance.DataBind();
            }
        }

        protected void gvAttendance_RowCommand(object sender, GridViewCommandEventArgs e)
        {
            int registrationId = Convert.ToInt32(e.CommandArgument);
            string status = e.CommandName == "MarkPresent" ? "Present" : "Absent";

            string connStr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString;
            using (var conn = new SqlConnection(connStr))
            {
                var cmd = new SqlCommand(
                    "INSERT INTO attendance (registration_id, attendance_status) VALUES (@rid, @status)", conn);
                cmd.Parameters.AddWithValue("@rid",    registrationId);
                cmd.Parameters.AddWithValue("@status", status);
                conn.Open();
                cmd.ExecuteNonQuery();
            }

            lblMessage.Text    = "Marked as " + status + ".";
            lblMessage.Visible = true;
            LoadData();
        }
    }
}
