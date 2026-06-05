using System;
using System.Web.UI;
using ClassLibrary;

namespace AdminSystem
{
    public partial class AdminLogin : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            // If already logged in, go straight to dashboard
            if (Session["AdminUsername"] != null)
                Response.Redirect("AdminDashboard.aspx");
        }

        protected void btnLogin_Click(object sender, EventArgs e)
        {
            string username = txtUsername.Text.Trim();
            string password = txtPassword.Text.Trim();

            if (string.IsNullOrEmpty(username) || string.IsNullOrEmpty(password))
            {
                lblError.Text    = "Username and password are required.";
                lblError.Visible = true;
                return;
            }

            Admin admin = Admin.ValidateLogin(username, password);

            if (admin != null)
            {
                Session["AdminUsername"] = admin.Username;
                Response.Redirect("AdminDashboard.aspx");
            }
            else
            {
                lblError.Text    = "Invalid username or password.";
                lblError.Visible = true;
            }
        }
    }
}
