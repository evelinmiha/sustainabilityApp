<?php # LOGIN HELPER FUNCTIONS.

# Function to load specified or default URL.
function load( $page = 'login.php' )
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page ;

  # Execute redirect then quit. 
  header( "Location: $url" ) ; 
  exit() ;
}

# Function to check email address and password. 
function validate( $link, $email = '', $pwd = '')
{
  # Initialize errors array.
  $errors = array(); 

  # Check email field.
  if (empty($email)) 
  { 
    $errors[] = 'Enter your email address.'; 
  } 
  else 
  { 
    $e = mysqli_real_escape_string($link, trim($email)); 
  }

  # Check password field.
  if (empty($pwd)) 
  { 
    $errors[] = 'Enter your password.'; 
  } 
  else 
  { 
    $p = mysqli_real_escape_string($link, trim($pwd)); 
  }

  # If there are no errors so far, check if the email exists.
  if (empty($errors)) 
  {
// First, check if it's the admin
$q = "SELECT admin_id, adminname FROM admin WHERE email='$e' AND password=SHA2('$p', 256)";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) == 1) {
  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
  $row['role'] = 'admin';
  return array(true, $row);
}

// Then, check regular users
    # Check if email exists in the database.
    $q = "SELECT company_id, company_name FROM company WHERE email='$e'";
    $r = mysqli_query($link, $q);
    
    # If email does not exist, add error.
    if (@mysqli_num_rows($r) == 0) 
    {
      $errors[] = 'Email address not found.';
    } 
    else 
    {
      # If email exists, now check the password.
      $q = "SELECT company_id, company_name FROM company WHERE email='$e' AND password=SHA2('$p', 256)";
      $r = mysqli_query($link, $q);

      # Check if email and password match.
      if (@mysqli_num_rows($r) == 1) 
      {
        # If email and password are correct, return user data.
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
        return array(true, $row);
      } 
      else 
      {
        $errors[] = 'Incorrect password.';
      }
    }
  }

  # On failure return error messages.
  return array(false, $errors);
}