<?php
session_start();

if (!isset($_SESSION['company_id'])) {
    echo "<p>No score available. Please complete the form.</p>";
    echo "<p><a href='greenCalculator.php' class='btn'>Go to Green Calculator</a></p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Score Results</title>
    <link rel="stylesheet" type="text/css" href="style.php">

    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 { color: #2c662d; }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px;
            background-color: #2c662d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover { background-color: #1e4720; }
    </style>
</head>
<body>
<?php include('navUser.php'); ?>
    <div class="container">
        <h1>Your Green Score</h1>
        <h2>Total Score: <?php echo $_SESSION['green_score']; ?> / 100</h2>
        <h3>Certification Level: <?php echo $_SESSION['certification']; ?></h3>

        <?php if ($_SESSION['shortfall'] > 0): ?>
            <p>You need <strong><?php echo $_SESSION['shortfall']; ?> points</strong> to reach the maximum.</p>
            <p>Donation Amount: <strong>£<?php echo $_SESSION['donationAmount']; ?></strong></p>
            <a href="shoppingTrolley.php" class="btn">Buy Vouchers</a>
        <?php endif; ?>
        <p><a href="certificate.php" class="btn">View Certificate</a></p>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>