<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription - Step 1</title>
    <link rel="stylesheet" href="style.php">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
require('connect_db.php');
include('navAdmin.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    # Validate company name
    if (empty($_POST['company_name'])) {
        $errors[] = 'Enter the company name.';
    } else {
        $c = mysqli_real_escape_string($link, trim($_POST['company_name']));
    }

    # Validate email
    if (empty($_POST['email'])) {
        $errors[] = 'Enter the email address.';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }

    # Validate password and confirm password
    if (!empty($_POST['password'])) {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $errors[] = 'Passwords do not match.';
        } else {
            $p = mysqli_real_escape_string($link, $_POST['password']);
        }
    } else {
        $errors[] = 'Enter the password.';
    }

    # Validate contact person
    if (empty($_POST['contact_person'])) {
        $errors[] = 'Enter the contact person.';
    } else {
        $cp = mysqli_real_escape_string($link, trim($_POST['contact_person']));
    }

    # Validate telephone number
    if (empty($_POST['telephone_number'])) {
        $errors[] = 'Enter the telephone number.';
    } else {
        $tn = mysqli_real_escape_string($link, trim($_POST['telephone_number']));
    }

    # Validate industry
    if (empty($_POST['industry'])) {
        $errors[] = 'Enter the industry.';
    } else {
        $in = mysqli_real_escape_string($link, trim($_POST['industry']));
    }

    # Validate address
    if (empty($_POST['address'])) {
        $errors[] = 'Enter the address.';
    } else {
        $ad = mysqli_real_escape_string($link, trim($_POST['address']));
    }

    # On success
    if (empty($errors)) {
        $q = "INSERT INTO company 
                (company_name, email, password, contact_person, telephone_number, industry, address, join_date, subscription_status)
              VALUES 
                (?, ?, SHA2(?, 256), ?, ?, ?, ?, NOW(), 'Active')";

        $stmt = mysqli_prepare($link, $q);
        mysqli_stmt_bind_param($stmt, 'sssssss', $c, $e, $p, $cp, $tn, $in, $ad);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo '<div class="alert alert-success text-center">Company account created successfully.</div>';
            echo '<div class="text-center"><a href="adminPage.php" class="btn btn-success">Return to Admin Page</a></div>';
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            exit();
        } else {
            echo '<div class="alert alert-danger text-center">Error: Could not create account.</div>';
        }

        mysqli_stmt_close($stmt);
    } else {
        echo '<div class="alert alert-danger"><ul>';
        foreach ($errors as $msg) echo "<li>$msg</li>";
        echo '</ul></div>';
    }
}
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Create New Company Account</h2>
    <form method="post" action="create.php">
        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Telephone Number</label>
            <input type="text" name="telephone_number" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Industry</label>
            <input type="text" name="industry" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Password (for login)</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Create Account</button>
    </form>
</div>

<?php include('footer.php'); ?>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>