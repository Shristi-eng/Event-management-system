<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="AdminDashboard.aspx.cs" Inherits="AdminSystem.AdminDashboard" %>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard – PlanBot</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #0d47a1; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header nav a { color: white; text-decoration: none; margin-left: 20px; }
        .hero { background: linear-gradient(135deg, #1565c0, #0d47a1); color: white; padding: 40px; text-align: center; }
        .dashboard-section { padding: 40px 30px; }
        .dashboard-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; max-width: 1100px; margin: 0 auto; }
        .dashboard-card { background: white; border-radius: 8px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
        .dashboard-card h2 { color: #0d47a1; margin-bottom: 10px; }
        .dashboard-card button { background: #0d47a1; color: white; border: none; padding: 10px 24px; border-radius: 4px; cursor: pointer; font-size: 14px; margin-top: 12px; }
        .dashboard-card button:hover { background: #1565c0; }
        footer { text-align: center; padding: 20px; background: #0d47a1; color: white; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <asp:Literal ID="litWelcome" runat="server"></asp:Literal>
            <a href="AdminLogin.aspx?logout=1">Logout</a>
        </nav>
    </header>
    <form id="form1" runat="server">
        <section class="hero">
            <h2>Welcome, Admin</h2>
            <p>Manage college events, registrations, and feedback from one place.</p>
        </section>
        <section class="dashboard-section">
            <div class="dashboard-container">
                <div class="dashboard-card">
                    <h2>Add Event</h2>
                    <p>Create and publish new college events.</p>
                    <a href="AddEvent.aspx"><button type="button">Open</button></a>
                </div>
                <div class="dashboard-card">
                    <h2>Edit Events</h2>
                    <p>Update event details and schedules.</p>
                    <a href="EditEvent.aspx"><button type="button">Open</button></a>
                </div>
                <div class="dashboard-card">
                    <h2>Delete Events</h2>
                    <p>Remove outdated or cancelled events.</p>
                    <a href="DeleteEvent.aspx"><button type="button">Open</button></a>
                </div>
                <div class="dashboard-card">
                    <h2>View Registrations</h2>
                    <p>Check students registered for events.</p>
                    <a href="ViewRegistrations.aspx"><button type="button">Open</button></a>
                </div>
                <div class="dashboard-card">
                    <h2>View Feedback</h2>
                    <p>Read feedback submitted by users.</p>
                    <a href="ViewFeedback.aspx"><button type="button">Open</button></a>
                </div>
                <div class="dashboard-card">
                    <h2>Statistics</h2>
                    <p>Monitor event participation and activity.</p>
                    <a href="Statistics.aspx"><button type="button">Open</button></a>
                </div>
                <div class="dashboard-card">
                    <h2>Attendance</h2>
                    <p>Manage student attendance and check-in.</p>
                    <a href="Attendance.aspx"><button type="button">Open</button></a>
                </div>
            </div>
        </section>
    </form>
    <footer><p>Email: planbot@yahoo.com | Phone: +45 87542109 | Nørre Voldgade 34, 1358 Copenhagen K</p></footer>
</body>
</html>
