<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
	  <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		 <!-- Custom Styles -->
     <link rel="stylesheet" href="style.php">
</head>
<body>

<?php
# Access session.
session_start() ; 

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'company_id' ] ) ) 
{ require ( 'login_tools.php' ) ; load() ; }

# Open database connection.
	require ( 'connect_db.php' ) ;
	
	 # Retrieve items from 'users' database table.
	 $q = "SELECT * FROM company WHERE company_id={$_SESSION['company_id']}" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
	 # Start HTML document.
	{
	
   # Include navigation (nav.php)
   include('navUser.php'); // Include the navigation bar here

  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
	$date= $row["join_date"];
	$day = substr($date, 8,2);
	$month = substr($date, 5,2);
	$year = substr($date, 0,4);
	
	echo '
	<div class="container mt-5">
		<h1 class="text-center">User Profile</h1>
		<div class="card">
			<div class="card-header">
				<h3>' . $row['contact_person'] . ' </h3>
			</div>
			<div class="card-body">
				<p><strong>Company name: </strong>' . $row['company_name'] . '</p>
				<p><strong>Email:</strong> ' . $row['email'] . '</p>
				<hr>
				<p><strong>Subsciption Date:</strong> ' . $day . '/' . $month . '/' . $year . '</p>
				<hr>
				<p><strong>Subsciption Status:</strong> ' .$row['subscription_status']. '</p>
				<hr>
			</div>
			<div class="card-footer text-center">
				<a href="changeDetails.php" class="btn btn-primary btn-sm">Change of details</a>
				<a href="certificate.php" class="btn btn-secondary btn-sm">Certificates</a>
				 <a href="editPaymentDetails.php" class="btn btn-warning btn-sm">Payment Details</a>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS and dependencies -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
		';
  }
	
  # Close database connection.
  #mysqli_close( $link ) ;
   # Include footer (footer.php)
   
   include('footer.php'); // Include the footer here -->
}
else { echo '<h3>No user details.</h3>

		' ; }
?>
		