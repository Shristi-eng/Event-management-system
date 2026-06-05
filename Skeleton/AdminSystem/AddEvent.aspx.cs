using System;
using System.Web.UI;
using ClassLibrary;

namespace AdminSystem
{
    public partial class AddEvent : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["AdminUsername"] == null)
                Response.Redirect("AdminLogin.aspx");
        }

        protected void btnAdd_Click(object sender, EventArgs e)
        {
            try
            {
                var ev = new Event();
                ev.EventName   = txtEventName.Text;
                ev.Location    = txtLocation.Text;
                ev.EventDate   = DateTime.Parse(txtEventDate.Text);
                ev.EventTime   = txtEventTime.Text;
                ev.Description = txtDescription.Text;

                var db = new EventDB();
                bool ok = db.InsertEvent(ev);

                if (ok)
                {
                    lblSuccess.Text    = "Event added successfully!";
                    lblSuccess.Visible = true;
                    lblError.Visible   = false;
                    ClearForm();
                }
                else
                {
                    lblError.Text    = "Failed to add event. Please try again.";
                    lblError.Visible = true;
                }
            }
            catch (ArgumentException ex)
            {
                lblError.Text    = ex.Message;
                lblError.Visible = true;
                lblSuccess.Visible = false;
            }
            catch (Exception)
            {
                lblError.Text    = "An unexpected error occurred. Please try again.";
                lblError.Visible = true;
            }
        }

        protected void btnReset_Click(object sender, EventArgs e)
        {
            ClearForm();
            lblError.Visible   = false;
            lblSuccess.Visible = false;
        }

        private void ClearForm()
        {
            txtEventName.Text  = "";
            txtLocation.Text   = "";
            txtEventDate.Text  = "";
            txtEventTime.Text  = "";
            txtDescription.Text = "";
        }
    }
}
