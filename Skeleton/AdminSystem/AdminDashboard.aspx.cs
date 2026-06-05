using System;
using System.Web.UI;

namespace AdminSystem
{
    public partial class AdminDashboard : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["AdminUsername"] == null)
                Response.Redirect("AdminLogin.aspx");

            // Handle logout
            if (Request.QueryString["logout"] == "1")
            {
                Session.Clear();
                Session.Abandon();
                Response.Redirect("AdminLogin.aspx");
            }

            litWelcome.Text = "Welcome, " + Server.HtmlEncode(Session["AdminUsername"].ToString()) + " | ";
        }
    }
}
