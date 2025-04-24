<?php
session_start();
require('connect_db.php'); // Ensure you have a database connection file

# Check if the user is logged in
if (!isset($_SESSION['company_id'])) {
    require('login_tools.php');
    load();  // Redirect to login page
    exit();
}

$company_id = $_SESSION['company_id']; // Get logged-in user's company ID


// Check subscription status
$subscription_query = "SELECT subscription_status FROM company WHERE company_id = $company_id";
$subscription_result = mysqli_query($link, $subscription_query);

if ($subscription_result && mysqli_num_rows($subscription_result) > 0) {
    $subscription_data = mysqli_fetch_assoc($subscription_result);
    $status = strtolower($subscription_data['subscription_status']);

    if ($status === 'deactivated') {
        header("Location: deactivateMessage.php");
        exit();
    }
} else {
    echo '<div class="error-message">
            Unable to verify subscription status. Please try again later.
          </div>';
    include('footer.php');
    exit();
}



$currentYear = date('Y');
// Check if a submission exists for the current year
$query = "SELECT greenCalculatorID FROM greencalculator 
          WHERE company_id = $company_id 
          AND YEAR(submission_date) = $currentYear";

$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    header("Location: greenCalculatorMessage.php");
    exit();
}

var_dump($link);

error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_SESSION['company_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Calculator</title>
    <link rel="stylesheet" type="text/css" href="style.php">

    <style>
        /* Container Styling */
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c662d;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #555;
        }

        /* Label Styling */
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        /* Dropdown Styling */
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: white;
            transition: background-color 0.3s ease-in-out;
        }

        /* Button Styling */
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background-color: #2c662d;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1e4720;
        }
    
        .error-message {
    background-color: #fdd;
    border: 1px solid #f00;
    color: #c00;
    padding: 15px;
    border-radius: 5px;
    margin-top: 20px;
    text-align: center;
}

    </style>

    <script>
        function updateColor(selectElement) {
            let color = selectElement.value;
            if (color == "0") {
                selectElement.style.backgroundColor = "#ffcccc"; // Light Red
            } else if (color == "5") {
                selectElement.style.backgroundColor = "#ffecb3"; // Light Amber
            } else if (color == "10") {
                selectElement.style.backgroundColor = "#c8e6c9"; // Light Green
            }
        }
         // Apply correct colors on page load
         window.onload = function() {
            let selects = document.querySelectorAll("select");
            selects.forEach(select => updateColor(select));
        }
    </script>
</head>
<body>
<?php include('navUser.php'); ?>
    <div class="container">
        <h1>Green Score Calculator</h1>
        <p>Each year, your company is invited to evaluate its sustainability performance across key areas of environmental responsibility. 
Please select the most accurate level for each measure below to reflect your practices over the past 12 months. 
Your honest and accurate input supports our mission of promoting good corporate citizenship and ensures compliance with sustainability regulations. 
Your responses contribute to a transparent, ethical, and greener future.</p>
        
<div style="text-align: left; margin: 20px 0; font-size: 16px; color: #333; font-family: 'Lato', sans-serif;">
    <h3 style="color: #2C5E1A; font-family: 'Merriweather', serif; font-size: 22px; margin-bottom: 10px;">Understanding Your Ratings</h3>
    <p>
        To clarify how performance levels are determined, let’s take the example of <strong>Waste Reduction</strong> – a common focus for most companies:
    </p>
    <ul style="list-style-type: disc; margin-left: 20px;">
        <li>A reduction of <strong>0%</strong> in waste compared to the previous year would be rated <span style="color: #c00;">🔴 Red</span>.</li>
        <li>A reduction of around <strong>5%</strong> would be rated <span style="color: #E65100;">🟠 Amber</span>.</li>
        <li>A reduction of <strong>10% or more</strong> would be rated <span style="color: #2C5E1A;">🟢 Green</span>.</li>
    </ul>
    <p>
        Similar logic applies to other categories in this calculator — please choose the most appropriate option based on your actual year-on-year performance.
    </p>
</div>
        <form action="rubricGreenCalculator.php" method="POST">

    <label>Carbon Emissions Reduction:</label>
            <select name="measure0" onchange="updateColor(this)" id="measure0">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

            <label>Waste Reduction:</label>
            <select name="measure1" onchange="updateColor(this)" id="measure1">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

            <label>Biodiversity Preservation:</label>
            <select name="measure2" onchange="updateColor(this)" id="measure2">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>


            <label>Energy Efficiency:</label>
            <select name="measure3" onchange="updateColor(this)" id="measure3">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

            <label>Sustainable Transport:</label>
            <select name="measure4" onchange="updateColor(this)" id="measure4">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

            <label>Eco-Friendly Products:</label>
            <select name="measure5" onchange="updateColor(this)" id="measure5">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

      
            <label>Sustainable Packaging:</label>
            <select name="measure6" onchange="updateColor(this)" id="measure6">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

            <label>Environmental Compliance:</label>
            <select name="measure7" onchange="updateColor(this)" id="measure7">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

            <label>Employee Sustainability Education:</label>
            <select name="measure8" onchange="updateColor(this)" id="measure8">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

            <label>Transparency & Reporting:</label>
            <select name="measure9" onchange="updateColor(this)" id="measure9">
                <option value="0">🔴 Red (0 pts)</option>
                <option value="5">🟠 Amber (5 pts)</option>
                <option value="10">🟢 Green (10 pts)</option>
            </select><br>

    <input type="submit" value="Calculate Score">
</form>
    </div>
    
    <?php include('footer.php'); ?>
</body>
</html>