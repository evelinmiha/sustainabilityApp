<?php
session_start();
require('connect_db.php');

class PasswordResetException extends Exception {}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Sanitize and retrieve inputs
        $email            = mysqli_real_escape_string($link, trim($_POST['email']));
        $company_name     = mysqli_real_escape_string($link, trim($_POST['company_name']));
        $address          = mysqli_real_escape_string($link, trim($_POST['address']));
        $new_password     = trim($_POST['new_password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Validation
        if (empty($email) || empty($company_name) || empty($address) || empty($new_password) || empty($confirm_password)) {
            throw new PasswordResetException('All fields are required.');
        }
        if ($new_password !== $confirm_password) {
            throw new PasswordResetException('Passwords do not match.');
        }

        // Verify user exists
        $q = sprintf(
            "SELECT company_id FROM company WHERE email='%s' AND company_name='%s' AND address='%s' LIMIT 1",
            mysqli_real_escape_string($link, $email),
            mysqli_real_escape_string($link, $company_name),
            mysqli_real_escape_string($link, $address)
        );
        $r = mysqli_query($link, $q);
        if (!$r || mysqli_num_rows($r) !== 1) {
            throw new PasswordResetException('No matching account found. Please check your details.');
        }

        // Update password using MySQL SHA2()
        $update = sprintf(
            "UPDATE company
             SET password = SHA2('%s', 256)
             WHERE email='%s' AND company_name='%s' AND address='%s'",
            mysqli_real_escape_string($link, $new_password),
            mysqli_real_escape_string($link, $email),
            mysqli_real_escape_string($link, $company_name),
            mysqli_real_escape_string($link, $address)
        );
        if (!mysqli_query($link, $update)) {
            throw new PasswordResetException('Database error updating password. Please try again.');
        }

        // On success, redirect to login with flag
        mysqli_close($link);
        header('Location: login.php?reset=success');
        exit;

    } catch (PasswordResetException $e) {
        $message = ['danger', $e->getMessage()];
    }
}

// Close connection if still open
if (isset($link) && $link) {
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.php">
</head>
<body style="background-color:#f0f7f4; font-family: 'Lato', sans-serif;">
    <?php include('nav.php'); ?>

    <div class="container my-5" style="max-width:500px; background:#fff; padding:30px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <h2 class="text-center mb-4" style="color:#2C5E1A;">Reset Your Password</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $message[0] ?> text-center"><?= htmlspecialchars($message[1]) ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Company Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Reset Password</button>
            <a href="login.php" class="btn btn-outline-secondary btn-block mt-2">Cancel</a>
        </form>
    </div>
</body>
</html>
