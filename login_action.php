<?php # PROCESS LOGIN ATTEMPT.

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Open database connection.
  require ( 'connect_db.php' ) ;

  # Get connection, load, and validate functions.
  require ( 'login_tools.php' ) ;

  # Check login.
  list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'password' ] ) ;

  # On success set session data and display logged in page.
  if ( $check )  
  {
    # Access session.
    session_start();

    if ($data['role'] === 'admin') {
      $_SESSION['admin_id'] = $data['admin_id'];
      $_SESSION['adminname'] = $data['adminname'];
      load('adminPage.php');

    } else {
    $_SESSION[ 'company_id' ] = $data[ 'company_id' ] ;
    $_SESSION[ 'company_name' ] = $data[ 'company_name' ] ;
    $_SESSION[ 'email' ] = $data[ 'email' ] ;
    load ( 'home.php' ) ;
  }
}
  # Or on failure set errors.
  else { $errors = $data; } 
  include('login.php');

  # Close database connection.
  mysqli_close( $link ) ; 
}

# Continue to display login page on failure.

?>