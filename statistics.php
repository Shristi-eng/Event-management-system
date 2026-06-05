<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

    exit();

}

include 'db_connect.php';

/* TOTAL EVENTS */

$events_query  = "SELECT COUNT(*) AS total_events FROM events";
$events_result = mysqli_query($conn, $events_query);
$events_data   = mysqli_fetch_assoc($events_result);

/* TOTAL REGISTRATIONS */

$registration_query  = "SELECT COUNT(*) AS total_registrations FROM registrations";
$registration_result = mysqli_query($conn, $registration_query);
$registration_data   = mysqli_fetch_assoc($registration_result);

/* TOTAL FEEDBACK */

$feedback_query  = "SELECT COUNT(*) AS total_feedback FROM feedback";
$feedback_result = mysqli_query($conn, $feedback_query);
$feedback_data   = mysqli_fetch_assoc($feedback_result);

/* TOTAL ATTENDANCE */

$attendance_query  = "SELECT COUNT(*) AS total_attendance FROM attendance";
$attendance_result = mysqli_query($conn, $attendance_query);
$attendance_data   = mysqli_fetch_assoc($attendance_result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Statistics Dashboard</title>

  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Statistics Dashboard</h1>

    </div>

    <!-- NAVIGATION -->
    <nav>
      <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>

        <li><a href="index.html">Home</a></li>
      </ul>
    </nav>

  </header>

  <!-- HERO SECTION -->
  <section class="hero">

    <h2>Event Statistics Overview</h2>

    <p>
      Monitor registrations, events, and audience engagement.
    </p>

  </section>

  <!-- STATISTICS SECTION -->
  <section class="statistics-section">

    <!-- TOP STAT CARDS -->
    <div class="stats-container">

      <!-- CARD 1 -->
      <div class="stats-card">

        <h2><?php echo (int)$events_data['total_events']; ?></h2>

        <p>Total Events</p>

      </div>

      <!-- CARD 2 -->
      <div class="stats-card">

        <h2><?php echo (int)$registration_data['total_registrations']; ?></h2>

        <p>Total Registrations</p>

      </div>

      <!-- CARD 3 -->
      <div class="stats-card">

        <h2><?php echo (int)$feedback_data['total_feedback']; ?></h2>

        <p>Feedback Received</p>

      </div>

      <!-- CARD 4 -->
      <div class="stats-card">

        <h2><?php echo (int)$attendance_data['total_attendance']; ?></h2>

        <p>Total Attendance</p>

      </div>

    </div>

    <!-- EVENT PARTICIPATION TABLE -->
    <div class="table-container">

      <table>

        <thead>

          <tr>
            <th>Statistic</th>
            <th>Total</th>
            <th>Status</th>
          </tr>

        </thead>

        <tbody>

          <tr>
            <td>Total Events</td>
            <td><?php echo (int)$events_data['total_events']; ?></td>
            <td>Active</td>
          </tr>

          <tr>
            <td>Total Registrations</td>
            <td><?php echo (int)$registration_data['total_registrations']; ?></td>
            <td>Updated</td>
          </tr>

          <tr>
            <td>Feedback Received</td>
            <td><?php echo (int)$feedback_data['total_feedback']; ?></td>
            <td>Updated</td>
          </tr>

          <tr>
            <td>Total Attendance</td>
            <td><?php echo (int)$attendance_data['total_attendance']; ?></td>
            <td>Updated</td>
          </tr>

        </tbody>

      </table>

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
