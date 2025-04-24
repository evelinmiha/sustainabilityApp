<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Page</title>
    <!-- Include any external CSS or JavaScript files here -->
    <link rel="stylesheet" type="text/css" href="style.php">
</head>

<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Access session (if needed)
 session_start();

# Include the correct navigation based on login status
if (isset($_SESSION['company_id'])) {
    include('navUser.php');  # Show user navigation
} else {
    include('nav.php');  # Show guest navigation
}

?>

<!-- Hero Section -->
<div class="information-hero">
    <div class="hero-content">
        <h1>Empowering a Sustainable Future</h1>
        <p>Our web-based platform helps companies achieve their green goals by offering tools for assessing and improving sustainability. With key features like our Green Calculator, sustainability vouchers, and valuable partnerships, we are paving the way for a cleaner, greener world.</p>
        <a href="#learn-more" class="btn">Learn More</a>
    </div>
</div>

<!-- Mission & Core Beliefs Section -->
<div class="container" id="learn-more">
    <h2>Our Mission</h2>
    <p>Our mission is to inspire and empower companies to embrace sustainable practices, reduce their carbon footprint, and contribute to a greener future for all. Through innovative tools and strategic partnerships, we aim to help businesses track, improve, and showcase their sustainability efforts.</p>
    
    <h3>Our Core Beliefs</h3>
    <ul>
        <li>🌱 Sustainability is the key to a thriving future for both businesses and the planet.</li>
        <li>⚡ Empowering businesses with the right tools and resources is essential for positive environmental impact.</li>
        <li>🌍 Every company, no matter its size, can make a significant difference in creating a more sustainable world.</li>
    </ul>

    <h3>Key Features of Our Platform</h3>
    <p>Our platform offers businesses a comprehensive solution to monitor and improve their sustainability performance through:</p>
    <ul>
        <li><strong>Green Calculator:</strong> A powerful tool that evaluates sustainability across 10 key measures such as energy efficiency, carbon emissions, waste reduction, and more.</li>
        <li><strong>Sustainability Vouchers:</strong> Companies can purchase vouchers to offset sustainability gaps and support global environmental initiatives like tree planting and renewable energy projects.</li>
        <li><strong>Transparent Certification:</strong> Receive a sustainability certification that enhances your company’s reputation and demonstrates commitment to green practices.</li>
    </ul>

    <h3>How It Works</h3>
    <p>With our Green Calculator, businesses can assess their performance based on sustainability measures, score each of them, and identify areas for improvement. If your score is less than perfect, you can purchase Green Vouchers to cover the gap and support impactful sustainability projects globally. Additionally, your business will receive a digital sustainability certificate to recognize your commitment to a greener future.</p>

    <p>In partnership with organizations like UNESCO, the funds generated through Green Vouchers will go towards projects such as tree planting and biodiversity conservation. By supporting these initiatives, you’ll play a role in tackling global environmental challenges.</p>
</div>

<?php if (!isset($_SESSION['company_id'])): ?>
<!-- Call to Action Section -->
<div class="cta">
    <h2>Make a Lasting Impact</h2>
    <p>Join a network of forward-thinking companies that are actively driving sustainability. Take action today and be part of the movement for a greener tomorrow.</p>
    <a href="login.php" class="btn">Get Involved</a>
</div>
<?php endif; ?>
<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>