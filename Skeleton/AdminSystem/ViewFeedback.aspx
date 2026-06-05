<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="ViewFeedback.aspx.cs" Inherits="AdminSystem.ViewFeedback" %>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <title>View Feedback – PlanBot</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #0d47a1; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header nav a { color: white; text-decoration: none; margin-left: 20px; }
        .hero { background: #1565c0; color: white; padding: 30px; text-align: center; }
        .table-section { padding: 40px 30px; }
        .table-wrapper { max-width: 1100px; margin: 0 auto; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th { background: #0d47a1; color: white; padding: 12px 16px; text-align: left; }
        td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) td { background: #f9f9f9; }
        footer { text-align: center; padding: 20px; background: #0d47a1; color: white; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>User Feedback</h1>
        <nav>
            <a href="AdminDashboard.aspx">Dashboard</a>
            <a href="AdminLogin.aspx?logout=1">Logout</a>
        </nav>
    </header>
    <div class="hero"><h2>Audience Feedback</h2><p>Review feedback submitted by participants.</p></div>
    <form id="form1" runat="server">
        <section class="table-section">
            <div class="table-wrapper">
                <asp:GridView ID="gvFeedback" runat="server" AutoGenerateColumns="false"
                    EmptyDataText="No feedback found.">
                    <Columns>
                        <asp:BoundField DataField="full_name"        HeaderText="Name" />
                        <asp:BoundField DataField="email"            HeaderText="Email" />
                        <asp:BoundField DataField="event_id"         HeaderText="Event ID" />
                        <asp:BoundField DataField="rating"           HeaderText="Rating" />
                        <asp:BoundField DataField="feedback_message" HeaderText="Feedback" />
                    </Columns>
                </asp:GridView>
            </div>
        </section>
    </form>
    <footer><p>Email: planbot@yahoo.com | Phone: +45 87542109</p></footer>
</body>
</html>
