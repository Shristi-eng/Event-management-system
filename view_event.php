<?php

include 'db_connect.php';

/* SORTING LOGIC */

$order = "";

if(isset($_GET['sort'])){

    $sort = $_GET['sort'];

    if($sort == "newest"){

        $order = "ORDER BY event_date DESC";

    }
    elseif($sort == "oldest"){

        $order = "ORDER BY event_date ASC";

    }
    elseif($sort == "az"){

        $order = "ORDER BY event_name ASC";

    }
    elseif($sort == "za"){

        $order = "ORDER BY event_name DESC";

    }

}
else{

    $order = "ORDER BY event_date DESC";

}

$sql = "SELECT * FROM events $order";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Upcoming Events</title>

  <link rel="stylesheet" href="style.css">

</head>

<body>

  <!-- HEADER -->
  <header>

    <h1>Upcoming College Events</h1>

    <a href="index.html" class="back-btn">

      Back to Home

    </a>

  </header>

  <!-- SORT DROPDOWN -->
  <section style="padding: 20px 40px;">

    <form method="GET">

      <select 
        name="sort"
        onchange="this.form.submit()"
        style="
          padding: 10px;
          border-radius: 6px;
          border: 1px solid #ccc;
          font-size: 16px;
        "
      >

        <option value="oldest">Sort Events</option>

        <option value="newest">Oldest First</option>

        <option value="oldest">Newest First</option>

        <option value="az">A - Z</option>

        <option value="za">Z - A</option>

      </select>

    </form>

  </section>

  <!-- EVENTS SECTION -->
  <main class="events-container">

<?php

while($row = mysqli_fetch_assoc($result)){

?>

<section class="event-card">

  <h2><?php echo $row['event_name']; ?></h2>

  <div class="event-info">

    <p>
      <strong>Location:</strong>

      <?php echo $row['location']; ?>
    </p>

    <p>
      <strong>Date:</strong>

      <?php echo $row['event_date']; ?>
    </p>

    <p>
      <strong>Time:</strong>

      <?php echo $row['event_time']; ?>
    </p>

    <p>
      <strong>Description:</strong>

      <?php echo $row['description']; ?>
    </p>

  </div>

  <a href="register_now.php">

    <button>Register</button>

  </a>

</section>

<?php

}

?>

  </main>

</body>
</html>