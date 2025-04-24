<?php
session_start();
require('connect_db.php');

if (!isset($_SESSION['company_id'])) {
    require('login_tools.php');
    load(); // Redirect to login
    exit();
}

$company_id = $_SESSION['company_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $fields = [
        'company_name' => 'Company name',
        'contact_person' => 'Contact person',
        'telephone_number' => 'Telephone number',
        'industry' => 'Industry',
        'address' => 'Address',
        'email' => 'Email'
    ];

    foreach ($fields as $key => $label) {
        if (empty($_POST[$key])) {
            $errors[] = "Enter your $label.";
        } else {
            $$key = mysqli_real_escape_string($link, trim($_POST[$key]));
        }
    }

    if (empty($errors)) {
        $q = "UPDATE company SET 
                company_name='$company_name',
                contact_person='$contact_person',
                telephone_number='$telephone_number',
                industry='$industry',
                address='$address',
                email='$email'
              WHERE company_id=$company_id";

        $r = mysqli_query($link, $q);
        $message = $r ? ['success', 'Details updated successfully.'] : ['danger', 'Error updating your details.'];
    } else {
        $message = ['warning', implode('<br>', $errors)];
    }
}

$q = "SELECT * FROM company WHERE company_id=$company_id";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
} else {
    echo '<div class="alert alert-danger">User not found.</div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Company Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Update Your Company Information</h3>

                    <?php if (isset($message)): ?>
                        <div class="alert alert-<?= $message[0]; ?>"><?= $message[1]; ?></div>
                    <?php endif; ?>

                    <form action="changeDetails.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" required value="<?= htmlspecialchars($row['company_name']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($row['email']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" required value="<?= htmlspecialchars($row['contact_person']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telephone Number</label>
                            <input type="text" name="telephone_number" class="form-control" required value="<?= htmlspecialchars($row['telephone_number']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Industry</label>
                            <input type="text" name="industry" class="form-control" required value="<?= htmlspecialchars($row['industry']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" required value="<?= htmlspecialchars($row['address']) ?>">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="user_account.php" class="text-muted">Back to User Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>