
<?php
session_start();

if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];  // Retrieve the company_id from the session
    echo "Company ID: " . $company_id;
} else {
    echo "No company_id found in the session.";
}

# Open database connection
require('connect_db.php');

class PaymentDetailsException extends Exception {}

# If form is submitted, process the input
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Get input data
    $card_number = mysqli_real_escape_string($link, $_POST['card_number']);
    $exp_month = (int) $_POST['exp_month'];
    $exp_year = (int) $_POST['exp_year'];
    $cvv = (int) $_POST['cvv'];

    $message = '';
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

            # Insert or update bank details
            $q = "INSERT INTO bank_details (company_id, card_number, exp_month, exp_year, cvv)
                  VALUES ('$company_id', '$card_number', '$exp_month', '$exp_year', '$cvv')
                  ON DUPLICATE KEY UPDATE card_number='$card_number', exp_month='$exp_month', exp_year='$exp_year', cvv='$cvv'";
            $r = mysqli_query($link, $q);
    
            if (!$r) {
                throw new PaymentDetailsException("Database error while saving payment details.");
            }
    
            $_SESSION['company_id'] = $company_id;
            header('Location: subscription_step3.php');
            exit();
    
        } catch (PaymentDetailsException $e) {
            $message = ['danger', $e->getMessage()];
        }
    }
    
    # Close database connection
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription - Step 2: Payment Details</title>
    <link rel="stylesheet" href="style.php">
      <!-- Bootstrap CSS -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
        <h1 class="text-center">Step 2: Add Your Payment Details</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">

                       <?php if (!empty($message)): ?>
                      <div class="alert alert-<?= $message[0] ?> text-center"><?= $message[1] ?></div>
                        <?php endif; ?>
                        <form action="subscription_step2.php?company_id=<?php echo $company_id; ?>" method="post" class="needs-validation" novalidate>
                            <!-- Card Number -->
                            <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Enter your card number" maxlength="16" pattern="\d{16}" required>
                                <div class="invalid-feedback">Please enter a valid 16-digit card number.</div>
                            </div>

                            <!-- Expiry Date -->
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <div class="d-flex">
                                    <input type="text" name="exp_month" class="form-control mr-2" placeholder="MM" maxlength="2" pattern="\d{2}" required>
                                    <input type="text" name="exp_year" class="form-control" placeholder="YY" maxlength="2" pattern="\d{2}" required>
                                </div>
                                <div class="invalid-feedback">Enter the expiry date in MM/YY format.</div>
                            </div>

                            <!-- CVV -->
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" name="cvv" id="cvv" class="form-control" placeholder="3-digit CVV" maxlength="3" pattern="\d{3}" required>
                                <div class="invalid-feedback">Please enter a valid 3-digit CVV.</div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-secondary btn-block">Complete Subscription</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Bootstrap validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
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
