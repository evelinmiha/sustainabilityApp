
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
<?php # DISPLAY COMPLETE REGISTRATION PAGE.
session_start();



# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 

  # Initialize an error array.
  $errors = array();

  # Check for company name.
  if ( empty( $_POST[ 'company_name' ] ) )
  { $errors[] = 'Enter your company name.' ; }
  else
  { $fn = mysqli_real_escape_string( $link, trim( $_POST[ 'company_name' ] ) ) ; }

  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }
  
  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT company_id FROM company WHERE email='$e'" ;
    $r = @mysqli_query ( $link, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 
	'Email address already registered. 
	<a class="alert-link" href="login.php">Sign In Now</a>' ;
  }
  
  
    # Check for contact person.
    if ( empty( $_POST[ 'contact_person' ] ) )
    { $errors[] = 'Enter your contact person.' ; }
    else
    { $cp = mysqli_real_escape_string( $link, trim( $_POST[ 'contact_person' ] ) ) ; }
  

  # Check for telephone number.
  if ( empty( $_POST[ 'telephone_number' ] ) )
  { $errors[] = 'Enter your telephone number.' ; }
  else
  { $tn = mysqli_real_escape_string( $link, trim( $_POST[ 'telephone_number' ] ) ) ; }

    # Check for industry.
    if ( empty( $_POST[ 'industry' ] ) )
    { $errors[] = 'Enter your industry.' ; }
    else
    { $in = mysqli_real_escape_string( $link, trim( $_POST[ 'industry' ] ) ) ; }


   # Check for address.
   if ( empty( $_POST[ 'address' ] ) )
   { $errors[] = 'Enter your address.' ; }
   else
   { $ad = mysqli_real_escape_string( $link, trim( $_POST[ 'address' ] ) ) ; }


  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO company (company_name,contact_person,telephone_number,industry,address, email, password) 
	VALUES ('$fn','$cp','$tn','$in','$ad', '$e', SHA2('$p',256))";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { 

         // Get the newly created user's ID
    $company_id = mysqli_insert_id($link); // Get last inserted ID

      // Redirect to Step 2 with the user_id passed in URL
   #   header('Location: subscription_step2.php?company_id=' . $company_id);
    // Redirect to the next page
    // Set the company_id in the session
$_SESSION['company_id'] = $company_id;
header('Location: subscription_step2.php');

      }
  
    # Close database connection.
    mysqli_close($link); 
    exit();
  }
  # Or report errors.
  else 
  {
    echo '
	<h4>The following error(s) occurred:</h4>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo '<p>or please try again.</p><br>';
    # Close database connection.
    mysqli_close( $link );
  }  
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Step 1: Create Your Account</h3>
                    <form action="subscription_step1.php" method="post">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company_name" required value="<?php if (isset($_POST['company_name'])) echo $_POST['company_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="pass1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass1" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass2" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="pass2" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" class="form-control" name="contact_person" required value="<?php if (isset($_POST['contact_person'])) echo $_POST['contact_person']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="telephone_number" class="form-label">Telephone Number</label>
                            <input type="text" class="form-control" name="telephone_number" required value="<?php if (isset($_POST['telephone_number'])) echo $_POST['telephone_number']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="industry" class="form-label">Industry</label>
                            <input type="text" class="form-control" name="industry" required value="<?php if (isset($_POST['industry'])) echo $_POST['industry']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" required value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>