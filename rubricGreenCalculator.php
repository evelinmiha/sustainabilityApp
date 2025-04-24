<?php
session_start();
require('connect_db.php'); // Ensure you have a database connection file
# Redirect if not logged in.
if (!isset($_SESSION['company_id'])) {
    require('login_tools.php'); 
    load();  # Redirect to login page
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $totalScore = 0;


    $totalScore += isset($_POST["measure0"]) ? (int)$_POST["measure0"] : 0;
    $totalScore += isset($_POST["measure1"]) ? (int)$_POST["measure1"] : 0;
    $totalScore += isset($_POST["measure2"]) ? (int)$_POST["measure2"] : 0;
    $totalScore += isset($_POST["measure3"]) ? (int)$_POST["measure3"] : 0;
    $totalScore += isset($_POST["measure4"]) ? (int)$_POST["measure4"] : 0;
    $totalScore += isset($_POST["measure5"]) ? (int)$_POST["measure5"] : 0;
    $totalScore += isset($_POST["measure6"]) ? (int)$_POST["measure6"] : 0;
    $totalScore += isset($_POST["measure7"]) ? (int)$_POST["measure7"] : 0;
    $totalScore += isset($_POST["measure8"]) ? (int)$_POST["measure8"] : 0;
    $totalScore += isset($_POST["measure9"]) ? (int)$_POST["measure9"] : 0;

    $shortfall = max(0, 100 - $totalScore);
    $donationAmount = $shortfall * 10;

    if ($totalScore >= 80) {
        $certification = "GOLD";
    } elseif ($totalScore >= 50) {
        $certification = "SILVER";
    } else {
        $certification = "BRONZE";
    }

    # Store values in session
    $_SESSION['green_score'] = $totalScore;
    $_SESSION['certification'] = $certification;
    $_SESSION['shortfall'] = $shortfall;
    $_SESSION['donationAmount'] = $donationAmount;


 # Insert data into the database (greenCalculator table)
 $company_id = $_SESSION['company_id']; // Get logged-in user's company ID

 // Get form values
 $car = isset($_POST["measure0"]) ? (int)$_POST["measure0"] : 0;
 $was = isset($_POST["measure1"]) ? (int)$_POST["measure1"] : 0;
 $bio = isset($_POST["measure2"]) ? (int)$_POST["measure2"] : 0;
 $ene = isset($_POST["measure3"]) ? (int)$_POST["measure3"] : 0;
 $tra = isset($_POST["measure4"]) ? (int)$_POST["measure4"] : 0;
 $eco = isset($_POST["measure5"]) ? (int)$_POST["measure5"] : 0;
 $pac = isset($_POST["measure6"]) ? (int)$_POST["measure6"] : 0;
 $com = isset($_POST["measure7"]) ? (int)$_POST["measure7"] : 0;
 $edu = isset($_POST["measure8"]) ? (int)$_POST["measure8"] : 0;
 $tran = isset($_POST["measure9"]) ? (int)$_POST["measure9"] : 0;

 // Insert query to store data into the greencalculator table
 $query = "INSERT INTO greencalculator 
             (carbonReduction, wasteReduction, biodiversity, energyEfficiency, transportationSustainability, ecoProducts, packaging, compliance, education, transparency, totalScore, company_id)
           VALUES 
             ('$car', '$was', '$bio', '$ene', '$tra', '$eco', '$pac', '$com', '$edu', '$tran','$totalScore', '$company_id')";

 // Execute the query and check for errors
 $result = mysqli_query($link, $query);

 if (!$result) {
     echo "<p style='color: red; text-align: center;'>Error: " . mysqli_error($link) . "</p>";
 } else {
     echo "<p style='color: green; text-align: center;'>Data successfully saved!</p>";

 // Get the submission date from the greencalculator table for this entry
 $calculator_id = mysqli_insert_id($link); // Gets the last inserted greencalculatorID

 // Optional: fetch submission_date if you're storing it automatically
 $submission_query = "SELECT submission_date FROM greencalculator WHERE greenCalculatorID = $calculator_id";
 $submission_result = mysqli_query($link, $submission_query);
 
 if ($submission_row = mysqli_fetch_assoc($submission_result)) {
     $issue_date = $submission_row['submission_date'];
 } else {
     $issue_date = date('Y-m-d'); // Fallback to current date
 }

 // Insert the certificate
 $cert_query = "INSERT INTO certificate (issueDate, level, company_id) 
                VALUES ('$issue_date', '$certification', '$company_id')";
 $cert_result = mysqli_query($link, $cert_query);

 if (!$cert_result) {
     echo "<p style='color: red; text-align: center;'>Certificate error: " . mysqli_error($link) . "</p>";
 }
}




 // Close the database connection
 mysqli_close($link);






    header("Location: rubricResult.php"); // Redirect to results page
    exit();
} else {
    echo "<p>Error: Form was not submitted correctly.</p>";
}
?>