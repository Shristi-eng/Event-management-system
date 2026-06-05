<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Admin Dashboard</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Admin Dashboard</h1>

    </div>

    <!-- NAVIGATION -->
    <nav>
      <ul>

        <li><a href="index.html">Home</a></li>

        <li><a href="view_event.php">Events</a></li>

        <li><a href="logout.php">Logout</a></li>

      </ul>
    </nav>

  </header>

  <!-- HERO SECTION -->
  <section class="hero">

    <h2>Welcome Admin</h2>

    <p>
      Manage college events, registrations, and feedback from one dashboard.
    </p>

  </section>

  <!-- DASHBOARD SECTION -->
  <section class="dashboard-section">

    <div class="dashboard-container">

      <!-- CARD 1 -->
      <div class="dashboard-card">

        <h2>Add Event</h2>

        <p>
          Create and publish new college events.
        </p>

        <a href="add_event.php">

          <button>Open</button>

        </a>

      </div>

      <!-- CARD 2 -->
      <div class="dashboard-card">

        <h2>Edit Events</h2>

        <p>
          Update event details and schedules.
        </p>

        <a href="edit_event.php">

          <button>Open</button>

        </a>

      </div>

      <!-- CARD 3 -->
      <div class="dashboard-card">

        <h2>Delete Events</h2>

        <p>
          Remove outdated or cancelled events.
        </p>

        <a href="delete_event.php">

          <button>Open</button>

        </a>

      </div>

      <!-- CARD 4 -->
      <div class="dashboard-card">

        <h2>View Registrations</h2>

        <p>
          Check students registered for events.
        </p>

        <a href="view_registration.php">

          <button>Open</button>

        </a>

      </div>

      <!-- CARD 5 -->
      <div class="dashboard-card">

        <h2>View Feedback</h2>

        <p>
          Read feedback submitted by users.
        </p>

        <a href="view_feedback.php">

          <button>Open</button>

        </a>

      </div>

      <!-- CARD 6 -->
      <div class="dashboard-card">

        <h2>Statistics</h2>

        <p>
          Monitor event participation and activity.
        </p>

        <a href="statistics.php">

          <button>Open</button>

        </a>

      </div>

      <!-- CARD 7 -->
      <div class="dashboard-card">

        <h2>Attendance</h2>

        <p>
          Manage student attendance and check-in system.
        </p>

        <a href="attendance.php">

          <button>Manage Attendance</button>

        </a>

      </div>

    </div>

  </section>

  <!-- FOOTER -->
  <footer>

    <h3>Contact Information</h3>

    <p>Email: planbot@yahoo.com</p>

    <p>Phone: +45 87542109</p>

    <p>Address: Nørre Voldgade 34 1358 Copenhagen K</p>

  </footer>

</body>
</html>