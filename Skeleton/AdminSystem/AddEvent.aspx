<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="AddEvent.aspx.cs" Inherits="AdminSystem.AddEvent" %>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <title>Add Event – PlanBot</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #0d47a1; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header nav a { color: white; text-decoration: none; margin-left: 20px; }
        .hero { background: #1565c0; color: white; padding: 30px; text-align: center; }
        .form-container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: bold; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-group { display: flex; gap: 10px; margin-top: 10px; }
        .submit-btn { padding: 12px 28px; background: #0d47a1; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        .submit-btn:hover { background: #1565c0; }
        .reset-btn  { padding: 12px 28px; background: #757575; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        .error-msg  { color: #721c24; background: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .success-msg{ color: #155724; background: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        footer { text-align: center; padding: 20px; background: #0d47a1; color: white; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Add New Event</h1>
        <nav>
            <a href="AdminDashboard.aspx">Dashboard</a>
            <a href="AdminLogin.aspx?logout=1">Logout</a>
        </nav>
    </header>
    <div class="hero"><h2>Create College Events</h2><p>Add new events for students and participants.</p></div>
    <form id="form1" runat="server">
        <div class="form-container">
            <h2>Event Details</h2>

            <asp:Label ID="lblError"   runat="server" Visible="false" CssClass="error-msg"></asp:Label>
            <asp:Label ID="lblSuccess" runat="server" Visible="false" CssClass="success-msg"></asp:Label>

            <div class="form-group">
                <asp:Label runat="server" AssociatedControlID="txtEventName" Text="Event Name (3–100 characters)"></asp:Label>
                <asp:TextBox ID="txtEventName" runat="server" placeholder="Enter event name"></asp:TextBox>
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtEventName"
                    ErrorMessage="Event name is required." ForeColor="Red" Display="Dynamic" />
            </div>

            <div class="form-group">
                <asp:Label runat="server" AssociatedControlID="txtLocation" Text="Location (max 150 characters)"></asp:Label>
                <asp:TextBox ID="txtLocation" runat="server" placeholder="Enter event location"></asp:TextBox>
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtLocation"
                    ErrorMessage="Location is required." ForeColor="Red" Display="Dynamic" />
            </div>

            <div class="form-group">
                <asp:Label runat="server" AssociatedControlID="txtEventDate" Text="Event Date"></asp:Label>
                <asp:TextBox ID="txtEventDate" runat="server" TextMode="Date"></asp:TextBox>
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtEventDate"
                    ErrorMessage="Event date is required." ForeColor="Red" Display="Dynamic" />
            </div>

            <div class="form-group">
                <asp:Label runat="server" AssociatedControlID="txtEventTime" Text="Event Time"></asp:Label>
                <asp:TextBox ID="txtEventTime" runat="server" TextMode="Time"></asp:TextBox>
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtEventTime"
                    ErrorMessage="Event time is required." ForeColor="Red" Display="Dynamic" />
            </div>

            <div class="form-group">
                <asp:Label runat="server" AssociatedControlID="txtDescription" Text="Description (10–1000 characters)"></asp:Label>
                <asp:TextBox ID="txtDescription" runat="server" TextMode="MultiLine" Rows="5"
                    placeholder="Write event details..."></asp:TextBox>
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtDescription"
                    ErrorMessage="Description is required." ForeColor="Red" Display="Dynamic" />
            </div>

            <div class="btn-group">
                <asp:Button ID="btnAdd"   runat="server" Text="Add Event" CssClass="submit-btn" OnClick="btnAdd_Click" />
                <asp:Button ID="btnReset" runat="server" Text="Reset"     CssClass="reset-btn"  CausesValidation="false" OnClick="btnReset_Click" />
            </div>
        </div>
    </form>
    <footer><p>Email: planbot@yahoo.com | Phone: +45 87542109</p></footer>
</body>
</html>
