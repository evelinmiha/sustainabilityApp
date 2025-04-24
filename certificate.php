<?php
session_start();

if (!isset($_SESSION['company_id'])) {
    require('login_tools.php');
    load(); // Redirect to login
    exit();
}
require('connect_db.php');

$company_id = $_SESSION['company_id'];


// Check if green calculation exists 
$query = "SELECT greenCalculatorID FROM greencalculator WHERE company_id = $company_id";

$result = mysqli_query($link, $query);

if (!$result || mysqli_num_rows($result) === 0) {
   header("Location: certificateMessage.php");
    exit();
}

// If record exists, proceed to fetch data
// Fetch voucher donation total
$q = "SELECT SUM(amount_paid) AS total_donated FROM vouchers WHERE company_id = $company_id";
$r = mysqli_query($link, $q);
$data = mysqli_fetch_assoc($r);
$total_donated = $data['total_donated'] ?? 0;

// Fetch current score and certification from session
$score = $_SESSION['green_score'] ?? 0;
$certification = $_SESSION['certification'] ?? 'BRONZE';
$company_name = $_SESSION['company_name'] ?? 'Your Company';

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate of Achievement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

       
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.php">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
            text-align: center;
        }

        .certificate {
            background: white;
            padding: 50px;
            border: 10px solid #2c662d;
            border-radius: 20px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }

        .certificate h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #2c662d;
        }

        .certificate h2 {
            color: #444;
            margin-top: 10px;
        }

        .highlight {
            color: #2c662d;
            font-weight: bold;
            font-size: 1.2em;
        }

        .cert-level {
            font-size: 2em;
            font-weight: bold;
            color: <?php
                echo ($certification == 'GOLD' ? '#d4af37' :
                      ($certification == 'SILVER' ? '#c0c0c0' : '#cd7f32'));
            ?>;
        }

        .download-btn {
            margin-top: 30px;
            display: inline-block;
            padding: 10px 20px;
            background: #2c662d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .download-btn:hover {
            background: #1e4720;
        }

        @media print {
            .download-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
<?php include('navUser.php'); ?>
<div class="certificate">
    <h1>Certificate of Achievement</h1>
    <h2>Presented to</h2>
    <h2 class="highlight"><?php echo htmlspecialchars($company_name); ?></h2>

    <p>For their commitment to sustainability and eco-friendly practices.</p>

    <p>Total Green Score Achieved: <span class="highlight"><?php echo $score; ?> / 100</span></p>
    <p>Certification Level: <span class="cert-level"><?php echo $certification; ?></span></p>

    <p>Total Voucher Donations: <span class="highlight">£<?php echo number_format($total_donated, 2); ?></span></p>

    <p>This contribution supports programs such as Tree Planting and UNESCO Environmental Initiatives.</p>

    <p>Date: <strong><?php echo date("d F Y"); ?></strong></p>

    <a href="#" class="download-btn" onclick="window.print()">🖨️ Print / Save as PDF</a>
</div>

</body>
</html>