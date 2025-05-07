<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Include any external CSS or JavaScript files here -->
    <link rel="stylesheet" type="text/css" href="style.php">
    
</head>

<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


# Access session.

 session_start();


# Include the correct navigation based on login status
if (isset($_SESSION['company_id'])) {
    include('navUser.php');  # Show user navigation
} else {
    include('nav.php');  # Show guest navigation
}
?>

 <!-- Hero Section -->
 <div class="hero" style="
    background-image: url('images/sustain.jpeg');
    background-size: cover;
    background-position: center;
">
 <div class="hero-content">
     <h1>Building a Greener Tomorrow</h1>
     <p>Our web-based platform is dedicated to helping companies embrace sustainability, 
        reduce their environmental impact, and join the journey toward a cleaner, more sustainable future.</p>
     <a href="#learn-more" class="btn">Learn More</a>
     </div>
 </div>
 
 <!-- Mission & Core Beliefs Section -->
 <div class="container" id="learn-more">
     <h2>Our Mission</h2>
     <p>Our mission is to empower businesses with the knowledge and tools to adopt sustainable practices, 
        assess their environmental impact, and actively contribute to the fight against climate change.</p>
    
     
     <h3>Our Core Beliefs</h3>
     <ul>
     <li>🌿 Reducing carbon emissions and promoting transparency are critical to achieving true environmental sustainability.</li>
        <li>⚡ Innovation, education, and staff engagement are the foundation of impactful environmental change.</li>
        <li>🌍 Every organization, regardless of size, plays a vital role in shaping a greener world.</li>
     </ul>
 </div>
 
 <?php if (!isset($_SESSION['company_id'])): ?>
 <!-- Call to Action -->
 <div class="cta">
     <h2>Join Us in Making a Difference</h2>

     <a href="login.php" class="btn">Get Involved</a>
 </div>
 <?php endif; ?>
 <?php include('footer.php'); ?>
</body>
</html>
