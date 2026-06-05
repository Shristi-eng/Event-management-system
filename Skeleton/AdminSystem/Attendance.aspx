<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Attendance.aspx.cs" Inherits="AdminSystem.Attendance" %>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <title>Attendance – PlanBot</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #0d47a1; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header nav a { color: white; text-decoration: none; margin-left: 20px; }
        .hero { background: #1565c0; color: white; padding: 30px; text-align: center; }
        .table-section { padding: 40px 30px; }
        .table-wrapper { max-width: 1000px; margin: 0 auto; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th { background: #0d47a1; color: white; padding: 12px 16px; text-align: left; }
        td { padding: 10px 16px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) td { background: #f9f9f9; }
        .present-btn { background: #1976d2; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; }
        .present-btn:hover { background: #388e3c; }
        .absent-btn  { background: #1976d2; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; }
        .absent-btn:hover  { background: #c62828; }
        .success-msg { color: #155724; background: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 4px; margin: 20px auto; max-width: 600px; text-align: center; }
        footer { text-align: center; padding: 20px; background: #0d47a1; color: white; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Attendance Management</h1>
        <nav>
            <a href="AdminDashboard.aspx">Dashboard</a>
            <a href="AdminLogin.aspx?logout=1">Logout</a>
        </nav>
    </header>
    <div class="hero"><h2>Manage Student Attendance</h2><p>Mark students as Present or Absent for events.</p></div>
    <form id="form1" runat="server">
        <asp:Label ID="lblMessage" runat="server" Visible="false" CssClass="success-msg"></asp:Label>
        <section class="table-section">
            <div class="table-wrapper">
                <asp:GridView ID="gvAttendance" runat="server" AutoGenerateColumns="false"
                    OnRowCommand="gvAttendance_RowCommand"
                    EmptyDataText="No registrations found.">
                    <Columns>
                        <asp:BoundField DataField="user_name"  HeaderText="Name" />
                        <asp:BoundField DataField="email"      HeaderText="Email" />
                        <asp:BoundField DataField="student_id" HeaderText="Student ID" />
                        <asp:BoundField DataField="event_id"   HeaderText="Event ID" />
                        <asp:TemplateField HeaderText="Present">
                            <ItemTemplate>
                                <asp:Button runat="server" Text="Present" CssClass="present-btn"
                                    CommandName="MarkPresent"
                                    CommandArgument='<%# Eval("id") %>' />
                            </ItemTemplate>
                        </asp:TemplateField>
                        <asp:TemplateField HeaderText="Absent">
                            <ItemTemplate>
                                <asp:Button runat="server" Text="Absent" CssClass="absent-btn"
                                    CommandName="MarkAbsent"
                                    CommandArgument='<%# Eval("id") %>' />
                            </ItemTemplate>
                        </asp:TemplateField>
                    </Columns>
                </asp:GridView>
            </div>
        </section>
    </form>
    <footer><p>Email: planbot@yahoo.com | Phone: +45 87542109</p></footer>
</body>
</html>
