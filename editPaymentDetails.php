<?php
session_start();
require('connect_db.php');

class PaymentDetailsException extends Exception {}

if (!isset($_SESSION['company_id'])) {
    echo '<div class="alert alert-danger text-center">You must be logged in to edit payment details.</div>';
    exit();
}

$company_id = $_SESSION['company_id'];
$message = '';

# Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $card_number = mysqli_real_escape_string($link, $_POST['card_number']);
    $exp_month = (int) $_POST['exp_month'];
    $cvv = (int) $_POST['cvv'];
    $exp_year = (int) $_POST['exp_year'];
    
    try {
   
     if (strlen($card_number) !== 16) {
        throw new PaymentDetailsException("Card number must be 16 digits.");
    }
    if ($exp_month < 1 || $exp_month > 12) {
        throw new PaymentDetailsException("Expiration month must be between 01 and 12.");
    }
    if (strlen($_POST['exp_year']) !== 2) {
        throw new PaymentDetailsException("Expiration year must be 2 digits.");
    }
    if (strlen($_POST['cvv']) !== 3) {
        throw new PaymentDetailsException("CVV must be 3 digits.");
    }
    
// First, delete any existing bank details for this company
$delete = "DELETE FROM bank_details WHERE company_id = $company_id";
mysqli_query($link, $delete);

// Then insert the new payment details
$q = "INSERT INTO bank_details (company_id, card_number, exp_month, exp_year, cvv)
      VALUES ('$company_id', '$card_number', '$exp_month', '$exp_year', '$cvv')";
$r = mysqli_query($link, $q);

        if (!$r) {
            throw new PaymentDetailsException("Database error while updating payment details.");
        } 
        $message = ['success', 'Payment details updated successfully.'];

    } catch (PaymentDetailsException $e) {
        $message = ['danger', $e->getMessage()];
    }
}
    
# Fetch existing payment details
$q = "SELECT * FROM bank_details WHERE company_id = $company_id";
$r = mysqli_query($link, $q);
$data = mysqli_fetch_array($r, MYSQLI_ASSOC);
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Payment Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-center mb-4">Edit Your Payment Details</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $message[0] ?> text-center"><?= $message[1] ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="editPaymentDetails.php" method="post" class="needs-validation" novalidate>
                        <!-- Card Number -->
                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" name="card_number" id="card_number" class="form-control" required
                                   value="<?= htmlspecialchars($data['card_number'] ?? '') ?>" pattern="\d{16}" maxlength="16"
                                   placeholder="16-digit card number">
                            <div class="invalid-feedback">Please enter a valid 16-digit card number.</div>
                        </div>

                   <!-- Expiry -->
            <div class="form-group">
               <label>Expiry Date</label>
                  <div class="form-row">
                     <div class="col">
                         <label for="exp_month" class="small text-muted">Month (MM)</label>
                             <input type="text" name="exp_month" id="exp_month" class="form-control" placeholder="MM"
                                maxlength="2" pattern="\d{2}" required
                                 value="<?= htmlspecialchars($data['exp_month'] ?? '') ?>">
                    </div>
                 <div class="col">
            <label for="exp_year" class="small text-muted">Year (YY)</label>
                  <input type="text" name="exp_year" id="exp_year" class="form-control" placeholder="YY"
                   maxlength="2" pattern="\d{2}" required
                   value="<?= htmlspecialchars($data['exp_year'] ?? '') ?>">
                   </div>
              </div>
         <div class="invalid-feedback">Enter a valid expiry month and year (MM/YY).</div>
        </div>


                        <!-- CVV -->
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" name="cvv" id="cvv" class="form-control" placeholder="CVV"
                                   value="<?= htmlspecialchars($data['cvv'] ?? '') ?>" maxlength="3" pattern="\d{3}" required>
                            <div class="invalid-feedback">Enter a 3-digit CVV.</div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                        <a href="user_account.php" class="btn btn-outline-secondary btn-block">Back to User Account</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and validation -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.forEach.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>