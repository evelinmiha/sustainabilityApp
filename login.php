<?php
include('nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
       <!-- Include the shared styles -->
       <link rel="stylesheet" type="text/css" href="style.php">
        <!-- Custom fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Merriweather:wght@700&family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #F2F7EC; /* Soft Green Background */
            font-family: 'Lato', Arial, sans-serif;
            color: #333333;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            justify-content: center;
            background: #DFF5E1; /* Light Green */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(44, 94, 26, 0.3);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2C5E1A;
            font-family: 'Merriweather', Georgia, serif;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            font-family: 'Lato', Arial, sans-serif;
            color: #4A752C;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #666666;
            border-radius: 5px;
            background: #fff;
            color: #333333;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #28a745; /* Primary CTA Green */
            border: none;
            padding: 12px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            text-transform: uppercase;
            font-family: 'Montserrat', Verdana, sans-serif;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        p {
            text-align: center;
            margin-top: 10px;
            color: #666666;
        }
        a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Member Login</h1>
        <p class="info">Only subscribed members can access the platform. Subscription: £99.99/year.</p>
        <form action="login_action.php" method="post">
            <label for="email">Email:</label>
            <input type="text" class="form-control" placeholder="Email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
        <p><a href="forgot_password.php">Forgot Password?</a></p>
        <p>Not a member? <a href="subscription_step1.php">Subscribe Now</a></p>
    </div>
</body>
</html>
