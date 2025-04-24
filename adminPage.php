<?php
# Access session.
session_start();
# Redirect if not logged in.
if (!isset($_SESSION['admin_id'])) {
  require('login_tools.php'); 
  load();  # Redirect to login page
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Include any external CSS or JavaScript files here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.php">
    <style>
    body {
      background-color: #F2F7EC;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(44, 94, 26, 0.2);
      margin-bottom: 30px;
    }
    .card-title {
      color: #2C5E1A;
      font-weight: 700;
    }
    .card-text {
      color: #4A752C;
    }
    .container h2 {
      color: #2C5E1A;
      margin-bottom: 20px;
      font-family: 'Merriweather', serif;
    }
  </style>
</head>

<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('navAdmin.php');  # Show guest navigation

# Open database connection.
require('connect_db.php');

# Retrieve users from 'company' database table.
$q = "SELECT * FROM company";
$r = mysqli_query($link, $q);

echo '<div class="container py-4">';
echo '<h2 class="text-center">Registered Companies</h2>';


if (mysqli_num_rows($r) > 0) {
    echo '<div class="row">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
            <div class="col-md-4">
          <div class="card">

<div class="card-body">
              <h5 class="card-title">' . htmlspecialchars($row['company_name']) . '</h5>
              <p class="card-text"><strong>Contact:</strong> ' . htmlspecialchars($row['contact_person']) . '</p>
              <p class="card-text"><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</p>
              <p class="card-text"><strong>Join Date:</strong> ' . htmlspecialchars($row['join_date']) . '</p>
              <p class="card-text"><strong>Subscription Status:</strong> ' . htmlspecialchars($row['subscription_status']) . '</p>
              <a href="update.php?company_id=' . htmlspecialchars($row['company_id']) . '" class="btn btn-success btn-block mb-2">Deactivate Subscription</a>
              <a href="delete.php?company_id=' . htmlspecialchars($row['company_id']) . '" class="btn btn-danger btn-sm">Delete Company</a>
            </div>
          </div>
        </div>';

    }
    echo '</div>'; // Close row
} else {
    echo '<p class="text-center">There are currently no companies to display.</p>';
}

echo '</div>'; // Close container



# Retrieve feedback from 'feedback' table
$q_feedback = "SELECT * FROM feedback ORDER BY submittedDate DESC";
$r_feedback = mysqli_query($link, $q_feedback);

echo '<div class="container py-4">';
echo '<h2 class="text-center">User Feedback</h2>';

if (mysqli_num_rows($r_feedback) > 0) {
    echo '<div class="row">';
    while ($feedback = mysqli_fetch_array($r_feedback, MYSQLI_ASSOC)) {
        echo '
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($feedback['fullName']) . '</h5>
                    <p class="card-text"><strong>Email:</strong> ' . htmlspecialchars($feedback['email']) . '</p>
                    <p class="card-text"><strong>Phone:</strong> ' . htmlspecialchars($feedback['contactNumber']) . '</p>
                    <p class="card-text"><strong>Message:</strong><br>' . nl2br(htmlspecialchars($feedback['message'])) . '</p>
                    <p class="card-text text-muted"><small>Submitted on ' . htmlspecialchars($feedback['submittedDate']) . '</small></p>
                </div>
            </div>
        </div>';
    }
    echo '</div>'; // Close feedback row
} else {
    echo '<p class="text-center">No feedback messages submitted yet.</p>';
}
echo '</div>'; // Close feedback container




 include('footer.php'); 

 # Close database connection.
mysqli_close($link);
?>
</body>
</html>