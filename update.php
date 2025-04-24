<?php

# Connect to the database.
require('connect_db.php');

if (isset($_GET['company_id'])) {
    $id = mysqli_real_escape_string($link, $_GET['company_id']);

    $sql = "UPDATE company 
            SET subscription_status = 'deactivated' 
            WHERE company_id = '$id'";

    if (mysqli_query($link, $sql)) {
        header("Location: adminPage.php");
        exit();
    } else {
        echo "Error updating subscription status: " . mysqli_error($link);
    }
} else {
    echo "No company ID provided.";
}

# Close database connection.
mysqli_close($link);
?>