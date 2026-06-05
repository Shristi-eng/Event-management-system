<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

    exit();

}

include 'db_connect.php';

$sql = "
SELECT registrations.*,
events.event_name

FROM registrations

INNER JOIN events

ON registrations.event_id = events.id
";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>View Registrations</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Event Registrations</h1>

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

    <h2>Registered Participants</h2>

    <p>
      View students registered for college events.
    </p>

  </section>

  <!-- TABLE SECTION -->
  <section class="registration-section">

    <div class="table-container">

      <table>

        <thead>
          <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Student ID</th>
            <th>Registered Event</th>
          </tr>
        </thead>

        <tbody>

<?php while($row = mysqli_fetch_assoc($result)): ?>

<tr>

  <td><?php echo htmlspecialchars($row['user_name']); ?></td>

  <td><?php echo htmlspecialchars($row['email']); ?></td>

  <td><?php echo htmlspecialchars($row['student_id']); ?></td>

  <td><?php echo htmlspecialchars($row['event_name']); ?></td>

</tr>

<?php endwhile; ?>

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
