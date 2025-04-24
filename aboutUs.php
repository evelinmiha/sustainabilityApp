<?php
// Start the session before any session-related logic
session_start();

// Include the correct navigation based on login status
if (isset($_SESSION['company_id'])) {
    include('navUser.php');  // Logged-in company navigation
} else {
    include('nav.php');      // Guest navigation
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Sustainability Hub</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>

    <div class="about-us">
        <h1>About Us</h1>

        <p><strong>Sustainability Hub</strong> is a web-based platform designed to help businesses assess, improve, and promote their environmental performance. Developed as part of an initiative by <strong>Edinburgh College</strong>, our goal is to empower UK companies to adopt greener practices in line with national sustainability targets and international frameworks like those of <strong>UNESCO</strong>.</p>

        <h2>Our Mission</h2>
        <p>We aim to drive real environmental change by helping businesses track their sustainability efforts through a structured scoring system. This tool encourages companies to adopt sustainable practices that reduce carbon emissions, promote energy efficiency, and support biodiversity.</p>

        <h2>Project Aims</h2>
        <ul>
            <li><strong>Improve sustainability by 10% annually</strong> – Our Green Calculator evaluates ten key sustainability criteria and helps businesses reach higher environmental performance every year.</li>
            <li><strong>Engage 500 companies in the first year</strong> – Through a subscription model (£99.99 annually), we aim to generate revenue that supports sustainability efforts while building a strong network of eco-conscious businesses.</li>
            <li><strong>Boost partnerships and certifications</strong> – By offering transparent sustainability certifications, we help companies build trust, enhance their reputation, and open B2B opportunities.</li>
            <li><strong>Offset environmental impact through vouchers</strong> – Companies can purchase vouchers to cover shortfalls in their score, with funds supporting verified initiatives like tree planting and UNESCO environmental programs.</li>
        </ul>

        <h2>Why It Matters</h2>
        <p>With government policies such as the UK Emissions Trading Scheme (ETS) and Net Zero 2050 goals, sustainability is more important than ever. Our app supports companies in staying compliant, accessing green finance, and appealing to a growing base of eco-aware consumers. Research shows that modern customers prefer to support environmentally responsible brands—and many are willing to pay more for certified sustainable products.</p>

        <p>We believe sustainability is not just a goal—it's a shared responsibility. Whether you’re a small business just starting your journey or a company seeking to solidify your green credentials, the Sustainability Hub is here to help.</p>
    </div>

    <?php
    // Include the footer
    include('footer.php');
    ?>

</body>
</html>