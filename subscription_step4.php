<?php
session_start();
if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];  // Retrieve the company_id from the session
    echo "Company ID: " . $company_id;
} else {
    echo "No company_id found in the session.";
}
require('connect_db.php');

class SubscriptionException extends Exception {}

try {
# Retrieve user information from 'company' database table using the company_id
$q = "SELECT company_name, contact_person, email FROM company WHERE company_id = $company_id";
$r = mysqli_query($link, $q);

if (! $r || mysqli_num_rows($r) === 0) {
    throw new SubscriptionException("Company information not found.");
}

    $company_info = mysqli_fetch_assoc($r);

 // ✅ Set the session variable here
$_SESSION['company_name'] = $company_info['company_name'];   

// Update the subscription status to 'active'
$update_q = "UPDATE company SET subscription_status = 'active' WHERE company_id = $company_id";

if (! mysqli_query($link, $update_q)) {
    throw new SubscriptionException("Failed to update subscription status.");
}
} catch (SubscriptionException $e) {
    // 5) Central error display
    echo '<div class="alert alert-danger text-center">'
         . htmlspecialchars($e->getMessage()) .
         '</div>';
    exit();
}



// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription - Step 4: Confirmation</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.php">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-body">



                <h2 class="mb-4 text-center">🎉 Subscription Confirmed</h2>

<p class="lead text-center">
    Thank you, <strong><?php echo htmlspecialchars($company_info['company_name']); ?></strong>!
</p>

<p>We are delighted to confirm your annual subscription of <strong>£99.99</strong> to our sustainability service.</p>

<p>We also extend our heartfelt thanks for your generous contribution to <strong>UNESCO's sustainability initiatives</strong>. Your support helps further their mission of creating a more sustainable world.</p>

<p>As part of our community, you now have access to exclusive tools and resources to help your company improve its sustainability performance. Aim for at least a <strong>10% annual improvement</strong> — we're here to help you achieve it!</p>

<p>Your commitment sets a positive example. Start exploring and make the most out of our platform!</p>

<hr>

<h4 class="mt-4">📋 Your Subscription Details</h4>
<ul class="list-group mb-4">
    <li class="list-group-item"><strong>Company Name:</strong> <?php echo htmlspecialchars($company_info['company_name']); ?></li>
    <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($company_info['email']); ?></li>
    <li class="list-group-item"><strong>Subscription Plan:</strong> £99.99/year</li>
</ul>

<p>If you need help, our support team is here for you.</p>

<div class="text-center">
    <a href="pointsGatheringPage.php" class="btn btn-success btn-lg mt-3">Go to Your Dashboard</a>
    </div>

</div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (opcional si usas funciones JS más adelante) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>