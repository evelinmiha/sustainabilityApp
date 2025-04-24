<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description Page</title>
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
<div class="description-hero" style="
    background-image: url('images/choice.jpg');
    background-size: cover;
    background-position: center;
">
    <div class="hero-content">
        <h1>Why Sustainability Matters</h1>
        <p>Environmental sustainability is no longer optional—it's a responsibility. Our platform helps businesses understand their environmental impact and take meaningful steps toward a greener future.</p>
        <a href="#reasons" class="btn">Discover More</a>
    </div>
</div>

<!-- Reasons for Sustainability -->
<div class="container" id="reasons">
    <h2>Why Embrace Sustainability?</h2>
    <p>Climate change and environmental degradation are among the biggest challenges facing humanity today. 
    Average personal carbon emissions in the UK still exceed sustainable levels, despite awareness campaigns.</p>

    <p>Our web-based sustainability system provides tools and education that support businesses 
        in aligning with climate goals through practical actions—tracking emissions, reducing waste, and promoting eco-friendly operations.</p>

        <div class="reasons-grid">
         <div class="reason">
            <img src="images/footprint.jpg" alt="Climate Action">
            <h3>🌍 Climate Responsibility</h3>
            <p>The average UK carbon footprint is 12.26 tCO2e, far exceeding the sustainable global target of 2.3 tCO2e. Addressing this is vital for meeting Paris Agreement commitments.</p>
            </div>
     
        <div class="reason">
        <img src="images/biodiversity.jpg" alt="Biodiversity">
            <h3>🌿 Protecting Ecosystems</h3>
            <p>Habitat loss and biodiversity decline threaten natural systems. Sustainable practices help preserve essential life-supporting ecosystems for generations to come.</p>
        </div>

        <div class="reason">
        <img src="images/habits.png" alt="Sustainable Habits">
            <h3>♻️ Everyday Impact</h3>
            <p>From waste reduction to sustainable packaging and transport, every small business choice contributes to a larger movement for a healthier planet.</p>
        </div>
    </div>


<!-- Promotional Images Section -->
<div class="promo-section">
    <h2>Empowering Businesses to Act</h2>
    <p>Our platform enables companies to evaluate their sustainability performance through 
        10 key measures and take action using data-driven tools like the Green Calculator.</p>

    <div class="voucher-display">
    <img src="images/vouchers.webp" alt="Green Vouchers" class="voucher-img">
    <img src="images/green_card.png" alt="Green Vouchers and Points" class="voucher-icon">
    </div>
</div>

<!-- UNESCO Partnership Section -->
<div class="unesco-partner">
    <h2>UNESCO & Global Sustainability</h2>
    <p>UNESCO plays a vital role in promoting sustainable development and environmental awareness worldwide.</p>
    <a href="https://en.unesco.org/themes/education-sustainable-development" target="_blank" class="btn">Visit UNESCO</a>
</div>

<?php if (!isset($_SESSION['company_id'])): ?>
<!-- Call to Action -->
<div class="cta">
    <h2>Join the Movement for a Sustainable Future</h2>
    <p>Become part of a growing network of businesses leading the way to a greener future.</p>
    <a href="login.php" class="btn">Get Involved</a>
</div>
<?php endif; ?>
<?php include('footer.php'); ?>
</body>
</html>