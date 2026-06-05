<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

    exit();

}

include 'db_connect.php';

$errors = [];
$success = '';

if(isset($_POST['add_event'])){

    $event_name  = trim($_POST['event_name']);
    $location    = trim($_POST['location']);
    $event_date  = trim($_POST['event_date']);
    $event_time  = trim($_POST['event_time']);
    $description = trim($_POST['description']);

    /* -- VALIDATION -- */

    if(empty($event_name)){
        $errors[] = "Event name is required.";
    } elseif(strlen($event_name) < 3){
        $errors[] = "Event name must be at least 3 characters.";
    } elseif(strlen($event_name) > 100){
        $errors[] = "Event name cannot exceed 100 characters.";
    }

    if(empty($location)){
        $errors[] = "Location is required.";
    } elseif(strlen($location) > 150){
        $errors[] = "Location cannot exceed 150 characters.";
    }

    if(empty($event_date)){
        $errors[] = "Event date is required.";
    } elseif($event_date < date('Y-m-d')){
        $errors[] = "Event date cannot be in the past.";
    }

    if(empty($event_time)){
        $errors[] = "Event time is required.";
    }

    if(empty($description)){
        $errors[] = "Description is required.";
    } elseif(strlen($description) < 10){
        $errors[] = "Description must be at least 10 characters.";
    } elseif(strlen($description) > 1000){
        $errors[] = "Description cannot exceed 1000 characters.";
    }

    /* -- INSERT (only if no errors) -- */

    if(empty($errors)){

        $stmt = mysqli_prepare($conn,
            "INSERT INTO events (event_name, location, event_date, event_time, description)
             VALUES (?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param($stmt, "sssss",
            $event_name, $location, $event_date, $event_time, $description
        );

        if(mysqli_stmt_execute($stmt)){
            $success = "Event added successfully!";
        } else {
            $errors[] = "Database error. Please try again.";
        }

        mysqli_stmt_close($stmt);

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Add Event</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Add New Event</h1>

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

    <h2>Create College Events</h2>

    <p>
      Add new events for students and participants.
    </p>

  </section>

  <!-- ADD EVENT FORM -->
  <main class="add-event-container">

    <form class="add-event-form" method="POST">

      <!-- VALIDATION MESSAGES -->
      <?php if(!empty($errors)): ?>
        <div class="error-box">
          <ul>
            <?php foreach($errors as $error): ?>
              <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if(!empty($success)): ?>
        <div class="success-box">
          <?php echo htmlspecialchars($success); ?>
        </div>
      <?php endif; ?>

      <!-- EVENT NAME -->
      <div class="form-group">

        <label>Event Name</label>

        <input
          type="text"
          name="event_name"
          placeholder="Enter event name (3-100 characters)"
          value="<?php echo isset($_POST['event_name']) ? htmlspecialchars($_POST['event_name']) : ''; ?>"
          required
        >

      </div>

      <!-- LOCATION -->
      <div class="form-group">

        <label>Location</label>

        <input
          type="text"
          name="location"
          placeholder="Enter event location"
          value="<?php echo isset($_POST['location']) ? htmlspecialchars($_POST['location']) : ''; ?>"
          required
        >

      </div>

      <!-- DATE -->
      <div class="form-group">

        <label>Event Date</label>

        <input
          type="date"
          name="event_date"
          min="<?php echo date('Y-m-d'); ?>"
          value="<?php echo isset($_POST['event_date']) ? htmlspecialchars($_POST['event_date']) : ''; ?>"
          required
        >

      </div>

      <!-- TIME -->
      <div class="form-group">

        <label>Event Time</label>

        <input
          type="time"
          name="event_time"
          value="<?php echo isset($_POST['event_time']) ? htmlspecialchars($_POST['event_time']) : ''; ?>"
          required
        >

      </div>

      <!-- DESCRIPTION -->
      <div class="form-group">

        <label>Description</label>

        <textarea
          name="description"
          placeholder="Write event details... (10-1000 characters)"
          rows="5"
          required
        ><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>

      </div>

      <!-- BUTTONS -->
      <div class="button-group">

       <button type="submit" name="add_event" class="submit-btn">
        Add Event
       </button>

        <button type="reset" class="reset-btn">
          Reset
        </button>

      </div>

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
