<?php
session_start();
require('connect_db.php');

if (!isset($_SESSION['company_id'])) {
    require('login_tools.php');
    load();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Deactivated</title>
    <link rel="stylesheet" type="text/css" href="style.php">
    <style>
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message-box {
            background-color: #fce4e4;
            border: 1px solid #e57373;
            color: #c62828;
            padding: 25px;
            border-radius: 8px;
            margin-top: 20px;
        }

        h2 {
            color: #2c662d;
        }

        a.btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #2c662d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        a.btn:hover {
            background-color: #1e4720;
        }
    </style>
</head>
<body>
    <?php include('navUser.php'); ?>

    <div class="container">
        <h2>Account Access Restricted</h2>
        <div class="message-box">
            <p><strong>Your account subscription is currently deactivated.</strong></p>
            <p>Please contact your administrator to reactivate your subscription and regain access to the Green Calculator.</p>
            <a href="home.php" class="btn">Return to Home</a>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>