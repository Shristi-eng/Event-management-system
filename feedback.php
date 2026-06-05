<?php

include 'db_connect.php';

if(isset($_POST['submit_feedback'])){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $event_id = $_POST['event_id'];
    $rating = $_POST['rating'];
    $feedback_message = $_POST['feedback_message'];

    $sql_feedback = "INSERT INTO feedback
    (full_name, email, event_id, rating, feedback_message)

    VALUES

    ('$full_name', '$email', '$event_id', '$rating', '$feedback_message')";

    if(mysqli_query($conn, $sql_feedback)){
        echo "<script>alert('Feedback Submitted Successfully');</script>";
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

  <title>Feedback</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Event Feedback</h1>

    </div>

    <!-- NAVIGATION -->
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="view_event.html">Events</a></li>
      </ul>
    </nav>

  </header>

  <!-- HERO SECTION -->
  <section class="hero">

    <h2>Share Your Feedback</h2>

    <p>
      Help us improve future college events with your valuable feedback.
    </p>

  </section>

  <!-- FEEDBACK FORM -->
  <main class="feedback-container">

    <form class="feedback-form" method="POST">

      <!-- NAME -->
      <div class="form-group">

        <label>Full Name</label>

        <input 
          type="text"
          name="full_name"
          placeholder="Enter your full name"
          required
        >

      </div>

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

      <!-- EVENT -->
      <div class="form-group">

        <label>Event Name</label>

<select name="event_id" required>

  <option value="">Select Event</option>

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

      <!-- RATING -->
      <div class="form-group">

        <label>Event Rating</label>

<select name="rating" required>

  <option value="">Choose Rating</option>

  <option>Excellent</option>

  <option>Good</option>

  <option>Average</option>

  <option>Poor</option>

</select>

      </div>

      <!-- MESSAGE -->
      <div class="form-group">

        <label>Your Feedback</label>

<textarea 
  name="feedback_message"
  rows="6"
  placeholder="Write your feedback here..."
  required
></textarea>

      </div>

<button type="submit" name="submit_feedback" class="submit-btn">
  Submit Feedback
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