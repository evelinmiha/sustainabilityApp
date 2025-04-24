<?php
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['company_id'])) {
    require('login_tools.php'); 
    load();  # Redirect to login page
    exit();
}
require('connect_db.php');

$company_id = $_SESSION['company_id'];
$q = "SELECT totalScore FROM greencalculator WHERE company_id = $company_id ORDER BY submission_date DESC LIMIT 1";
$r = mysqli_query($link, $q);
$row = mysqli_fetch_assoc($r);
$score = isset($row['totalScore']) ? $row['totalScore'] : 'Not available';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Points Gathering</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>

<?php
include('navUser.php');?>
    <div class="container">
        <h1>Track Your Sustainability Points</h1>
        <p>Monitor your green efforts and improve your sustainability score.</p>
        
        <div class="points-info">
            <h2>Your Current Score: <span id="userPoints"><?php echo $score; ?></span></h2>
            <p>Each sustainability measure is rated as:</p>
            <ul>
                <li>🔴 <strong>Red:</strong> Not meeting the criteria (0 points)</li>
                <li>🟠 <strong>Amber:</strong> Partial compliance (5 points)</li>
                <li>🟢 <strong>Green:</strong> Fully compliant (10 points)</li>
            </ul>
        </div>
        
        <div class="vouchers">
            <h2>Need More Points?</h2>
            <p>You can purchase sustainability vouchers to compensate for any shortfall in points. All proceeds support eco-friendly projects.</p>
            <a href="shoppingTrolley.php" class="btn">Buy Vouchers</a>
        </div>
    </div>
    
    <?php include('footer.php'); ?>
    
</body>
</html>
