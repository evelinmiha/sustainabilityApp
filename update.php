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
# Include navigation 
include('navAdmin.php');

# Connect to the database.
require('connect_db.php');

# Initialize an error array.
$errors = array();

// Check for a valid company ID from the URL.
if (isset($_GET['company_id']) && is_numeric($_GET['company_id'])) {
    $company_id = mysqli_real_escape_string($link, trim($_GET['company_id']));
    
    # Fetch the existing company data from the database.
    $q = "SELECT * FROM company WHERE company_id='$company_id'";
    $result = mysqli_query($link, $q);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        $errors[] = 'Company not found.';
    }
} else {
    $errors[] = 'Invalid company ID.';
}

# If the form was submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Validate and sanitize inputs.
    if (empty($_POST['company_name'])) {
        $errors[] = 'Update company name.';
    } else {
        $company_name = mysqli_real_escape_string($link, trim($_POST['company_name']));
    }

    if (empty($_POST['contact_person'])) {
        $errors[] = 'Update contact person.';
    } else {
        $contact_person = mysqli_real_escape_string($link, trim($_POST['contact_person']));
    }

    if (empty($_POST['email'])) {
        $errors[] = 'Update email address.';
    } else {
        $email = mysqli_real_escape_string($link, trim($_POST['email']));
    }

    if (empty($_POST['telephone_number'])) {
        $errors[] = 'Update telephone number.';
    } else {
        $telephone_number = mysqli_real_escape_string($link, trim($_POST['telephone_number']));
    }

    if (empty($_POST['industry'])) {
        $errors[] = 'Update industry.';
    } else {
        $industry = mysqli_real_escape_string($link, trim($_POST['industry']));
    }

    if (empty($_POST['address'])) {
        $errors[] = 'Update address.';
    } else {
        $address = mysqli_real_escape_string($link, trim($_POST['address']));
    }

    # If no errors, update the record.
    if (empty($errors)) {
        $q = "UPDATE company SET 
                company_name='$company_name', 
                contact_person='$contact_person', 
                email='$email', 
                telephone_number='$telephone_number', 
                industry='$industry', 
                address='$address' 
                WHERE company_id='$company_id'";
        $r = @mysqli_query($link, $q);

        if ($r) {
            header("Location: adminPage.php");  # Redirect back to the admin page
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($link);
        }
    }
}

# Close database connection.
mysqli_close($link);
?>

<form action="update.php?company_id=<?php echo htmlspecialchars($company_id); ?>" method="post">
    <div class="form-group">
        <label for="company_name">Company Name</label>
        <input type="text" name="company_name" class="form-control" value="<?php echo isset($row['company_name']) ? htmlspecialchars($row['company_name']) : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="contact_person">Contact Person</label>
        <input type="text" name="contact_person" class="form-control" value="<?php echo isset($row['contact_person']) ? htmlspecialchars($row['contact_person']) : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="telephone_number">Telephone Number</label>
        <input type="text" name="telephone_number" class="form-control" value="<?php echo isset($row['telephone_number']) ? htmlspecialchars($row['telephone_number']) : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="industry">Industry</label>
        <input type="text" name="industry" class="form-control" value="<?php echo isset($row['industry']) ? htmlspecialchars($row['industry']) : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" class="form-control" required><?php echo isset($row['address']) ? htmlspecialchars($row['address']) : ''; ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Company</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>
