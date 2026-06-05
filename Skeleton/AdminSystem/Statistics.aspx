<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Statistics.aspx.cs" Inherits="AdminSystem.Statistics" %>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <title>Statistics – PlanBot</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #0d47a1; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header nav a { color: white; text-decoration: none; margin-left: 20px; }
        .hero { background: #1565c0; color: white; padding: 30px; text-align: center; }
        .stats-section { padding: 40px 30px; }
        .stats-container { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; max-width: 900px; margin: 0 auto 40px; }
        .stats-card { background: white; border-radius: 8px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
        .stats-card h2 { font-size: 42px; color: #0d47a1; margin: 0 0 8px; }
        .table-wrapper { max-width: 700px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th { background: #0d47a1; color: white; padding: 12px 16px; text-align: left; }
        td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) td { background: #f9f9f9; }
        footer { text-align: center; padding: 20px; background: #0d47a1; color: white; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Statistics Dashboard</h1>
        <nav>
            <a href="AdminDashboard.aspx">Dashboard</a>
            <a href="AdminLogin.aspx?logout=1">Logout</a>
        </nav>
    </header>
    <div class="hero"><h2>Event Statistics Overview</h2><p>Monitor registrations, events, and audience engagement.</p></div>
    <form id="form1" runat="server">
        <section class="stats-section">
            <div class="stats-container">
                <div class="stats-card">
                    <h2><asp:Literal ID="litEvents" runat="server"></asp:Literal></h2>
                    <p>Total Events</p>
                </div>
                <div class="stats-card">
                    <h2><asp:Literal ID="litRegistrations" runat="server"></asp:Literal></h2>
                    <p>Total Registrations</p>
                </div>
                <div class="stats-card">
                    <h2><asp:Literal ID="litFeedback" runat="server"></asp:Literal></h2>
                    <p>Feedback Received</p>
                </div>
                <div class="stats-card">
                    <h2><asp:Literal ID="litAttendance" runat="server"></asp:Literal></h2>
                    <p>Total Attendance</p>
                </div>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Statistic</th><th>Total</th><th>Status</th></tr></thead>
                    <tbody>
                        <tr><td>Total Events</td>        <td><asp:Literal ID="litEventsT"        runat="server"></asp:Literal></td><td>Active</td></tr>
                        <tr><td>Total Registrations</td> <td><asp:Literal ID="litRegistrationsT" runat="server"></asp:Literal></td><td>Updated</td></tr>
                        <tr><td>Feedback Received</td>   <td><asp:Literal ID="litFeedbackT"      runat="server"></asp:Literal></td><td>Updated</td></tr>
                        <tr><td>Total Attendance</td>    <td><asp:Literal ID="litAttendanceT"    runat="server"></asp:Literal></td><td>Updated</td></tr>
                    </tbody>
                </table>
            </div>
        </section>
    </form>
    <footer><p>Email: planbot@yahoo.com | Phone: +45 87542109</p></footer>
</body>
</html>
