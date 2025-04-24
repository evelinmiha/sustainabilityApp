<?php
session_start(); 
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
# Redirect if not logged in
if (!isset($_SESSION['company_id'])) { 
    require('login_tools.php'); 
    load(); 
    exit();
}


# Open database connection
require('connect_db.php');
include('navUser.php'); 

# Custom Exception Class
class DonationException extends Exception {}
# Get user ID
$user_id = $_SESSION['company_id'];
$error_message = null;

try {
# Check if user has bank details
$q = "SELECT * FROM bank_details WHERE company_id = '$user_id'";
$r = mysqli_query($link, $q);

# Redirect to payment details if missing
if (mysqli_num_rows($r) == 0) {
    mysqli_close($link);
    header('Location: payment_details.php');
    exit();
}

# Fetch donation quantity and total
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0;
$total = isset($_POST['total']) ? (float) $_POST['total'] : 0;


# Ensure quantity and total are valid (cannot be 0 or negative)
if ($quantity <= 0 || $total <= 0) {
    throw new DonationException("Invalid quantity or total amount. Please go back and try again.");
}

# Ensure the quantity is at least the shortfall
$shortfall = isset($_SESSION['shortfall']) ? $_SESSION['shortfall'] : 0;


if ($quantity < $shortfall) {
    throw new DonationException("You cannot purchase fewer points than your shortfall requires. Please go back and adjust.");
}

# Insert donation record
$q = "INSERT INTO vouchers (points_purchased, amount_paid, company_id) VALUES ($quantity, $total, $user_id)";
$r = mysqli_query($link, $q);

if (!$r) {
    throw new DonationException("Donation could not be recorded.");
}


# Clear session shortfall
unset($_SESSION['shortfall']);

} catch (DonationException $e) {
    $error_message = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voucher Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add this inside the <head> -->
<link rel="stylesheet" href="style.php"> <!-- Use your custom stylesheet -->


    <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">  
   <!-- <link rel="stylesheet" type="text/css" href="style.php">-->
</head>
<body class="bg-custom">

    <?php if ($error_message): ?>
           <div class="container mt-5">
        <div class="card p-4 bg-danger text-white">
            <div class="alert alert-danger bg-danger text-white">
                <h4 class="alert-heading">Error</h4>
                <p><?= $error_message ?></p>
                <hr>
                <p>Please try again or go back and adjust your input.</p>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="container mt-5">
        <div class="card p-4 bg-light">
            <div class="alert alert-success text-dark">
                <h4 class="alert-heading" style="color: #000;">Thank You for Your Contribution!</h4>
                <p style="color: #000;">Your donation has been processed successfully. Below are the details:</p>
                <hr>
                <p><strong>Total Donated:</strong> 
                    <span style="color: #28a745;">£<?= number_format($total, 2) ?></span>
                </p>
                <p><strong>Donation Date:</strong> 
                    <span style="color: #17a2b8;"><?= date("d/m/Y") ?></span>
                </p>
                <hr>
                <p style="color: #000;">Your support is greatly appreciated. Thank you for making a difference!</p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php mysqli_close($link); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>