<?php

include 'db_connect.php';

if(isset($_POST['register'])){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];
    $event_id = $_POST['event_id'];

    $sql_register = "INSERT INTO registrations
    (user_name, email, student_id, event_id)

    VALUES

    ('$full_name', '$email', '$student_id', '$event_id')";

    if(mysqli_query($conn, $sql_register)){
        echo "<script>alert('Registration Successful');</script>";
    }
    else{
        echo "Error: " . mysqli_error($conn);
    }

}

$sql = "SELECT * FROM events ORDER BY event_date ASC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Register For Events</title>

 
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>
    <div class="logo-section">
      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Event Registration</h1>
    </div>

    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="view_event.html">Events</a></li>
      </ul>
    </nav>
  </header>

  <!-- PAGE TITLE -->
  <section class="hero">
    <h2>Register as Audience</h2>

    <p>
      Select an event and fill in your details to participate.
    </p>
  </section>

  <!-- REGISTRATION FORM -->
  <main class="register-container">

    <form class="register-form" method="POST">

      <!-- NAME -->
      <div class="form-group">
        <label>Full Name</label>

        <input type="text" name="full_name" placeholder="Enter your name" required>
      </div>

      <!-- EMAIL -->
      <div class="form-group">
        <label>Email Address</label>

        <input type="email" name="email" placeholder="Enter your email" required>
      </div>

      <!-- STUDENT ID -->
      <div class="form-group">
        <label>Student ID</label>

        <input type="text" name="student_id" placeholder="Enter student ID" required>
      </div>

      <!-- EVENT SELECTION -->
      <div class="form-group">
        <label>Select Event</label>

<select name="event_id" required>

  <option value="">Choose Event</option>

  <?php

  while($row = mysqli_fetch_assoc($result)){

  ?>

  <option value="<?php echo $row['id']; ?>">

    <?php echo $row['event_name']; ?>

  </option>

  <?php

  }

  ?>

</select>
      </div>

      <!-- ROLE -->
      <div class="form-group">
        <label>Participation Type</label>

        <input type="text" value="Audience" readonly>
      </div>

<button type="submit" name="register" class="submit-btn">
  Register Now
</button>

    </form>

  </main>

</body>
</html>