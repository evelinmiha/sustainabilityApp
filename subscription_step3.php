<?php
session_start();

if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];  // Retrieve the company_id from the session
    echo "Company ID: " . $company_id;
} else {
    echo "No company_id found in the session.";
}
# Open database connection
require('connect_db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['card_number'] = $_POST['card_number'];
    $_SESSION['exp_month'] = $_POST['exp_month'];
    $_SESSION['exp_year'] = $_POST['exp_year'];
    $_SESSION['cvv'] = $_POST['cvv'];
}

# Retrieve user information from 'company' database table.
$q = "SELECT company_name, contact_person, email FROM company WHERE company_id = $company_id";
$r = mysqli_query($link, $q);


// Check if the query was successful and the data was retrieved




    if ($r && mysqli_num_rows($r) > 0) {
    $company_info = mysqli_fetch_assoc($r);
    
    // If user confirms subscription, redirect to step 4
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
        header('Location: subscription_step4.php');
        exit();
    }

}else {
        echo '<div class="alert alert-danger text-center">Company not found.</div>';
        exit();
    }
    
# Close database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription - Step 3</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.php">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body">

    <h2 class="mb-4 text-center">Step 3: Confirm Subscription</h2>

<ul class="list-group mb-4">
    <li class="list-group-item"><strong>Company Name:</strong> <?php echo htmlspecialchars($company_info['company_name']); ?></li>
    <li class="list-group-item"><strong>Contact Person:</strong> <?php echo htmlspecialchars($company_info['contact_person']); ?></li>
    <li class="list-group-item"><strong>Email Address:</strong> <?php echo htmlspecialchars($company_info['email']); ?></li>
    <li class="list-group-item"><strong>Subscription Plan:</strong> £99.99/year</li>
</ul>

<form action="subscription_step4.php" method="post" class="text-center">
    <input type="hidden" name="confirm" value="1">
    <button type="submit" class="btn btn-success btn-lg">Confirm & Subscribe</button>
</form>
    </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
