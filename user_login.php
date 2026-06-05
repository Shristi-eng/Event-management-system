<?php

include 'db_connect.php';

if(isset($_POST['user_login'])){

    $email = $_POST['email'];

    $password = $_POST['password'];

    $login_sql = "SELECT * FROM users
    WHERE email='$email'
    AND password='$password'";

    $result = mysqli_query($conn, $login_sql);

    if(mysqli_num_rows($result) > 0){

        header("Location: user_dashboard.php");

    }
    else{

        echo "<script>alert('Invalid Email or Password');</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>User Login</title>

  <link rel="stylesheet" href="style.css">

</head>

<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>User Login</h1>

    </div>

    <nav>
      <ul>

        <li><a href="index.html">Home</a></li>

        <li><a href="view_event.php">Events</a></li>

        <li><a href="register_now.php">Register</a></li>

      </ul>
    </nav>

  </header>

  <!-- HERO -->
  <section class="hero">

    <h2>Student Login Portal</h2>

    <p>
      Login using credentials provided by admin.
    </p>

  </section>

  <!-- LOGIN FORM -->
  <main class="login-container">

    <form class="login-form" method="POST">

      <!-- EMAIL -->
      <div class="form-group">

        <label>Email Address</label>

        <input 
          type="email"
          name="email"
          placeholder="Enter your email"
          required
        >

      </div>

      <!-- PASSWORD -->
      <div class="form-group">

        <label>Password</label>

        <input 
          type="password"
          name="password"
          placeholder="Enter password"
          required
        >

      </div>

      <!-- LOGIN BUTTON -->
      <button type="submit" name="user_login" class="submit-btn">

        Login

      </button>

    </form>

  </main>

  <!-- FOOTER -->
  <footer>

    <h3>Contact Information</h3>

    <p>Email: planbot@yahoo.com</p>

    <p>Phone: +45 87542109</p>

    <p>Address: Nørre Voldgade 34 1358 Copenhagen K</p>

  </footer>

</body>
</html>