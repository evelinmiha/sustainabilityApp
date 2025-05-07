<?php
# DISPLAY COMPLETE LOGGED OUT PAGE.

# Access session.
session_start();

# Clear existing variables.
$_SESSION = array();

# Destroy the session.
session_unset();
session_destroy();


# Redirect to home page.
header('Location: home.php');
exit();

?>
