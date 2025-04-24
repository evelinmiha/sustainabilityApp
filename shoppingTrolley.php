<?php
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['company_id'])) {
    require('login_tools.php');
    load();
    exit();
}

# Ensure shortfall information is available.
if (!isset($_SESSION['shortfall']) || $_SESSION['shortfall'] == 0) {
    echo "<div class='container'><div class='alert alert-success'>No donation needed. Your sustainability score is perfect!</div>";
    echo "<a href='greenCalculator.php' class='btn btn-primary'>Go Back</a></div>";
    exit();
}

$shortfall = $_SESSION['shortfall'];
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
    </div>

    <?php include('footer.php'); ?>
</body>
</html>