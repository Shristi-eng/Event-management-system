<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="DeleteEvent.aspx.cs" Inherits="AdminSystem.DeleteEvent" %>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <title>Delete Events – PlanBot</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #0d47a1; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header nav a { color: white; text-decoration: none; margin-left: 20px; }
        .hero { background: #1565c0; color: white; padding: 30px; text-align: center; }
        .delete-section { padding: 40px 30px; }
        .delete-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; max-width: 1100px; margin: 0 auto; }
        .delete-card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .delete-card h2 { color: #0d47a1; margin-bottom: 10px; }
        .delete-btn { background: #c62828; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; margin-top: 12px; font-size: 14px; }
        .delete-btn:hover { background: #b71c1c; }
        .success-msg{ color: #155724; background: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 4px; margin: 20px auto; max-width: 600px; }
        footer { text-align: center; padding: 20px; background: #0d47a1; color: white; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Delete Events</h1>
        <nav>
            <a href="AdminDashboard.aspx">Dashboard</a>
            <a href="AdminLogin.aspx?logout=1">Logout</a>
        </nav>
    </header>
    <div class="hero"><h2>Manage Existing Events</h2><p>Remove outdated or cancelled college events.</p></div>
    <form id="form1" runat="server">
        <asp:Label ID="lblMessage" runat="server" Visible="false" CssClass="success-msg"></asp:Label>
        <section class="delete-section">
            <div class="delete-container">
                <asp:Repeater ID="rptEvents" runat="server">
                    <ItemTemplate>
                        <div class="delete-card">
                            <h2><%# Eval("EventName") %></h2>
                            <p><strong>Location:</strong> <%# Eval("Location") %></p>
                            <p><strong>Date:</strong> <%# Eval("EventDate", "{0:dd MMM yyyy}") %></p>
                            <p><strong>Time:</strong> <%# Eval("EventTime") %></p>
                            <asp:Button runat="server" Text="Delete Event" CssClass="delete-btn"
                                CommandName="Delete"
                                CommandArgument='<%# Eval("EventId") %>'
                                OnCommand="btnDelete_Command"
                                OnClientClick="return confirm('Are you sure you want to delete this event? This cannot be undone.');" />
                        </div>
                    </ItemTemplate>
                </asp:Repeater>
            </div>
        </section>
    </form>
    <footer><p>Email: planbot@yahoo.com | Phone: +45 87542109</p></footer>
</body>
</html>
