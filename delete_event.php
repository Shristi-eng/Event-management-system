<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

    exit();

}

include 'db_connect.php';

$delete_message = '';

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    if(!is_numeric($id)){

        $delete_message = "Invalid event ID.";

    } else {

        $stmt = mysqli_prepare($conn, "DELETE FROM events WHERE id = ?");

        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)){

            $delete_message = "Event deleted successfully.";

        } else {

            $delete_message = "Error deleting event. Please try again.";

        }

        mysqli_stmt_close($stmt);

    }

}

$sql    = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Delete Events</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Delete Events</h1>

    </div>

    <!-- NAVIGATION -->
    <nav>
      <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="view_event.php">Events</a></li>
      </ul>
    </nav>

  </header>

  <!-- HERO SECTION -->
  <section class="hero">

    <h2>Manage Existing Events</h2>

    <p>
      Remove outdated or cancelled college events.
    </p>

  </section>

  <!-- STATUS MESSAGE -->
  <?php if(!empty($delete_message)): ?>
    <div style="text-align:center; padding:10px; margin:10px auto; max-width:600px;
                background:#d4edda; border:1px solid #c3e6cb; border-radius:6px; color:#155724;">
      <?php echo htmlspecialchars($delete_message); ?>
    </div>
  <?php endif; ?>

  <!-- DELETE EVENT SECTION -->
  <section class="delete-section">

    <div class="delete-container">

<?php while($row = mysqli_fetch_assoc($result)): ?>

<div class="delete-card">

  <h2><?php echo htmlspecialchars($row['event_name']); ?></h2>

  <p>
    <strong>Location:</strong>
    <?php echo htmlspecialchars($row['location']); ?>
  </p>

  <p>
    <strong>Date:</strong>
    <?php echo htmlspecialchars($row['event_date']); ?>
  </p>

  <p>
    <strong>Time:</strong>
    <?php echo htmlspecialchars($row['event_time']); ?>
  </p>

  <a
    href="delete_event.php?delete=<?php echo htmlspecialchars($row['id']); ?>"
    onclick="return confirm('Are you sure you want to delete \'<?php echo htmlspecialchars(addslashes($row['event_name'])); ?>\'? This action cannot be undone.');"
  >

    <button class="delete-btn">
      Delete Event
    </button>

  </a>

</div>

<?php endwhile; ?>

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
