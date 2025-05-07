<?php
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['company_id'])) {
    require('login_tools.php');
    load();
    exit();
}
require('connect_db.php'); // make sure this connects $link
$company_id = $_SESSION['company_id'];

# Fetch latest totalScore
$q = "SELECT totalScore FROM greencalculator WHERE company_id = $company_id ORDER BY submission_date DESC LIMIT 1";
$r = mysqli_query($link, $q);
$row = mysqli_fetch_assoc($r);
$score = $row ? (int)$row['totalScore'] : null;

# Fetch total purchased vouchers
$q2 = "SELECT SUM(points_purchased) AS total_purchased FROM vouchers WHERE company_id = $company_id";
$r2 = mysqli_query($link, $q2);
$row2 = mysqli_fetch_assoc($r2);
$purchased = isset($row2['total_purchased']) ? (int)$row2['total_purchased'] : 0;

# Define the maximum score (assumed to be 100)
$targetScore = 100;

if ($score === null) {
    // Green calculator not used yet
    $shortfall = 0;
    $showDonationNeeded = false;
} else {


$shortfall = max($targetScore - $score - $purchased, 0); // prevent negative shortfalls
$showDonationNeeded = ($shortfall > 0);
}

$voucherPrice = 10;
$total = $shortfall * $voucherPrice;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Trolley</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.php">
    <script>
        function updateQuantity(change) {
            let quantityInput = document.getElementById('quantity_voucher');
            let quantity = parseInt(quantityInput.value);

            quantity += change;
            if (quantity < 1) return;

            quantityInput.value = quantity;
            updateTotal(quantity);
        }

        function updateTotal(quantity) {
            let price = 10;
           let total = quantity * price;

    // Update on-screen total
    document.getElementById('totalCost').innerText = "£" + total.toFixed(2);

    // ✅ Update hidden input that goes with form submission
    document.getElementById('post_total').value = total.toFixed(2);
        }
    </script>
</head>
<body class="bg-custom">
<?php include('navUser.php'); ?>
    <div class="container mt-5">
        <h1 class="text-center">Shopping Trolley</h1>
        

        <?php if (!$showDonationNeeded): ?>
        <div class="alert alert-success text-center">
            <h4>No donation needed.</h4>
            <a href="greenCalculator.php" class="btn btn-primary mt-3">Go Back</a>
        </div>
    <?php else: ?>

            <div class="card bg-light p-4">
            <form method="POST" action="checkout.php" id="checkoutForm">
                <div class="mb-3">
                    <h5>Vouchers for Sustainability Shortfall</h5>
                    <p>Your shortfall: <strong><?php echo $shortfall; ?> points</strong></p>
                    <p>Each point costs: <strong>£10</strong></p>
                </div>
                
                <div class="input-group mb-3">
                    <button class="btn btn-dark" type="button" onclick="updateQuantity(-1)">-</button>
                    <input type="text" class="form-control text-center" id="quantity_voucher" name="quantity" value="<?php echo $shortfall; ?>" readonly>
                    <button class="btn btn-dark" type="button" onclick="updateQuantity(1)">+</button>
                </div>

                <p><strong>Total Cost: <span id="totalCost">£<?php echo number_format($total, 2); ?></span></strong></p>

                <!-- Hidden inputs to be submitted securely -->
                <input type="hidden" name="total" id="post_total" value="<?php echo $total; ?>">
                <button type="submit" class="btn btn-success btn-block">Proceed to Checkout</button>
            </form>
        </div>

        <div class="text-center mt-3">
            <a href="rubricResult.php" class="btn btn-secondary">Back to Results</a>
        </div>
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
