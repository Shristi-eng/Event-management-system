<?php

include 'db_connect.php';

/* DELETE REGISTRATION */

if(isset($_GET['cancel'])){

    $id = $_GET['cancel'];

    $delete_sql = "DELETE FROM registrations
    WHERE id='$id'";

    mysqli_query($conn, $delete_sql);

}

/* FETCH USER REGISTRATIONS WITH EVENT NAMES */

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

  <title>User Dashboard</title>

  <link rel="stylesheet" href="style.css">

</head>

<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>User Dashboard</h1>

    </div>

    <nav>
      <ul>

        <li><a href="index.html">Home</a></li>

        <li><a href="view_event.php">Events</a></li>

      </ul>
    </nav>

  </header>

  <!-- HERO -->
  <section class="hero">

    <h2>My Event Registrations</h2>

    <p>
      View and manage your registered events.
    </p>

  </section>

  <!-- REGISTRATION TABLE -->
  <section class="registration-section">

    <div class="table-container">

      <table>

        <thead>

          <tr>

            <th>Name</th>

            <th>Email</th>

            <th>Student ID</th>

            <th>Event Name</th>

            <th>Action</th>

          </tr>

        </thead>

        <tbody>

          <?php

          while($row = mysqli_fetch_assoc($result)){

          ?>

          <tr>

            <td>

              <?php echo $row['user_name']; ?>

            </td>

            <td>

              <?php echo $row['email']; ?>

            </td>

            <td>

              <?php echo $row['student_id']; ?>

            </td>

            <td>

              <?php echo $row['event_name']; ?>

            </td>

            <td>

              <a href="user_dashboard.php?cancel=<?php echo $row['id']; ?>">

                <button class="delete-btn">

                  Cancel Registration

                </button>

              </a>

            </td>

          </tr>

          <?php

          }

          ?>

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