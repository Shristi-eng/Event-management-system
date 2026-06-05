using System;
using System.Web.UI;
using ClassLibrary;

namespace AdminSystem
{
    public partial class Statistics : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["AdminUsername"] == null)
                Response.Redirect("AdminLogin.aspx");

            if (!IsPostBack)
                LoadStats();
        }

        private void LoadStats()
        {
            var db = new EventDB();
            string ev   = db.CountEvents().ToString();
            string reg  = db.CountRegistrations().ToString();
            string fb   = db.CountFeedback().ToString();
            string att  = db.CountAttendance().ToString();

            litEvents.Text        = ev;   litEventsT.Text        = ev;
            litRegistrations.Text = reg;  litRegistrationsT.Text = reg;
            litFeedback.Text      = fb;   litFeedbackT.Text      = fb;
            litAttendance.Text    = att;  litAttendanceT.Text    = att;
        }
    }
}
