using System;
using System.Configuration;
using System.Data.SqlClient;
using System.Data;
using System.Web.UI;

namespace AdminSystem
{
    public partial class ViewRegistrations : Page
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
                var cmd = new SqlCommand(
                    "SELECT r.user_name, r.email, r.student_id, e.event_name " +
                    "FROM registrations r INNER JOIN events e ON r.event_id = e.event_id", conn);
                var da = new SqlDataAdapter(cmd);
                var dt = new DataTable();
                da.Fill(dt);
                gvRegistrations.DataSource = dt;
                gvRegistrations.DataBind();
            }
        }
    }
}
