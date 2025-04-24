<?php
# Open database connection.
require ( 'connect_db.php' ) ;

if (isset($_GET['company_id'])) {
  $id = $_GET['company_id'];
}
$sql = "DELETE FROM company WHERE company_id='$id'";
if ($link->query($sql) === TRUE) {
    header("Location: adminPage.php");
} else {
    echo "Error deleting record: " . $link->error;
}
?>