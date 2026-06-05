<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="AdminLogin.aspx.cs" Inherits="AdminSystem.AdminLogin" %>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login – PlanBot</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #0d47a1; color: white; padding: 15px 30px; }
        .login-container { max-width: 400px; margin: 60px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .submit-btn { width: 100%; padding: 12px; background: #0d47a1; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .submit-btn:hover { background: #1565c0; }
        .error-msg { color: #721c24; background: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        footer { text-align: center; padding: 20px; color: #666; margin-top: 40px; }
    </style>
</head>
<body>
    <header><h1>PlanBot – Administrator Login</h1></header>
    <form id="form1" runat="server">
        <div class="login-container">
            <h2>Admin Login</h2>

            <asp:Label ID="lblError" runat="server" Visible="false" CssClass="error-msg"></asp:Label>

            <div class="form-group">
                <asp:Label runat="server" AssociatedControlID="txtUsername" Text="Username"></asp:Label>
                <asp:TextBox ID="txtUsername" runat="server" placeholder="Enter admin username"></asp:TextBox>
                <asp:RequiredFieldValidator ID="rfvUsername" runat="server"
                    ControlToValidate="txtUsername"
                    ErrorMessage="Username is required."
                    ForeColor="Red" Display="Dynamic" />
            </div>

            <div class="form-group">
                <asp:Label runat="server" AssociatedControlID="txtPassword" Text="Password"></asp:Label>
                <asp:TextBox ID="txtPassword" runat="server" TextMode="Password" placeholder="Enter password"></asp:TextBox>
                <asp:RequiredFieldValidator ID="rfvPassword" runat="server"
                    ControlToValidate="txtPassword"
                    ErrorMessage="Password is required."
                    ForeColor="Red" Display="Dynamic" />
            </div>

            <asp:Button ID="btnLogin" runat="server" Text="Login" CssClass="submit-btn"
                OnClick="btnLogin_Click" />
        </div>
    </form>
    <footer><p>Email: planbot@yahoo.com | Phone: +45 87542109</p></footer>
</body>
</html>
