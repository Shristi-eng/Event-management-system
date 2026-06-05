using System;
using System.Web.UI;
using System.Web.UI.WebControls;
using ClassLibrary;

namespace AdminSystem
{
    public partial class DeleteEvent : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["AdminUsername"] == null)
                Response.Redirect("AdminLogin.aspx");

            if (!IsPostBack)
                BindEvents();
        }

        private void BindEvents()
        {
            var db = new EventDB();
            rptEvents.DataSource = db.GetAllEvents();
            rptEvents.DataBind();
        }

        protected void btnDelete_Command(object sender, CommandEventArgs e)
        {
            if (e.CommandName == "Delete")
            {
                int id = Convert.ToInt32(e.CommandArgument);
                var db = new EventDB();
                bool ok = db.DeleteEvent(id);

                lblMessage.Text    = ok ? "Event deleted successfully." : "Could not delete event.";
                lblMessage.Visible = true;
                BindEvents();
            }
        }
    }
}
