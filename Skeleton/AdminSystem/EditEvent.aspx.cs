using System;
using System.Web.UI;
using System.Web.UI.WebControls;
using ClassLibrary;

namespace AdminSystem
{
    public partial class EditEvent : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["AdminUsername"] == null)
                Response.Redirect("AdminLogin.aspx");

            if (!IsPostBack)
                LoadEvents();
        }

        private void LoadEvents()
        {
            var db     = new EventDB();
            var events = db.GetAllEvents();
            ddlEvents.Items.Clear();
            ddlEvents.Items.Add(new ListItem("-- Select an Event --", "0"));
            foreach (var ev in events)
                ddlEvents.Items.Add(new ListItem(ev.EventName, ev.EventId.ToString()));
        }

        protected void ddlEvents_SelectedIndexChanged(object sender, EventArgs e)
        {
            int id = int.Parse(ddlEvents.SelectedValue);
            if (id == 0) return;

            var db = new EventDB();
            var ev = db.GetEventById(id);
            if (ev != null)
            {
                txtEventName.Text  = ev.EventName;
                txtLocation.Text   = ev.Location;
                txtEventDate.Text  = ev.EventDate.ToString("yyyy-MM-dd");
                txtEventTime.Text  = ev.EventTime;
                txtDescription.Text = ev.Description;
            }
        }

        protected void btnUpdate_Click(object sender, EventArgs e)
        {
            int id = int.Parse(ddlEvents.SelectedValue);
            if (id == 0)
            {
                lblError.Text    = "Please select a valid event.";
                lblError.Visible = true;
                return;
            }

            try
            {
                var ev = new Event();
                ev.EventId     = id;
                ev.EventName   = txtEventName.Text;
                ev.Location    = txtLocation.Text;
                ev.EventDate   = DateTime.Parse(txtEventDate.Text);
                ev.EventTime   = txtEventTime.Text;
                ev.Description = txtDescription.Text;

                var db = new EventDB();
                bool ok = db.UpdateEvent(ev);

                if (ok)
                {
                    lblSuccess.Text    = "Event updated successfully!";
                    lblSuccess.Visible = true;
                    lblError.Visible   = false;
                    LoadEvents();
                }
                else
                {
                    lblError.Text    = "Failed to update event. Please try again.";
                    lblError.Visible = true;
                }
            }
            catch (ArgumentException ex)
            {
                lblError.Text    = ex.Message;
                lblError.Visible = true;
                lblSuccess.Visible = false;
            }
        }

        protected void btnReset_Click(object sender, EventArgs e)
        {
            txtEventName.Text   = "";
            txtLocation.Text    = "";
            txtEventDate.Text   = "";
            txtEventTime.Text   = "";
            txtDescription.Text = "";
            lblError.Visible    = false;
            lblSuccess.Visible  = false;
        }
    }
}
