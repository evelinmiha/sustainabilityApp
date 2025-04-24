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
    <title>Privacy Policy</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <h1>Privacy Policy</h1>

    <h2>Effective Date: [17/12/2024]</h2>

    <p>At [Edinburgh Cinema], we value your privacy. This Privacy Policy outlines how we collect, use, disclose, and safeguard your information when you visit our website. Please read this policy carefully. By accessing or using our website, you agree to the collection and use of your information as described in this policy.</p>

    <h3>1. Information We Collect</h3>
    <p>We may collect the following types of information:</p>
    <ul>
        <li><strong>Personal Information:</strong> Name, email address, phone number, billing information, etc.</li>
        <li><strong>Usage Data:</strong> Information about how you access and use our website, including IP addresses, browser types, and usage patterns.</li>
        <li><strong>Cookies and Tracking Technologies:</strong> We may use cookies, web beacons, and other tracking technologies to enhance your experience on our website.</li>
    </ul>

    <h3>2. How We Use Your Information</h3>
    <p>We use the information we collect for various purposes, including:</p>
    <ul>
        <li>To provide and maintain our services</li>
        <li>To notify you about changes to our services</li>
        <li>To offer customer support</li>
        <li>To analyze website usage and improve our content and user experience</li>
        <li>To send you promotional materials, newsletters, and other updates (with your consent)</li>
    </ul>

    <h3>3. Sharing Your Information</h3>
    <p>We do not share your personal information with third parties except in the following situations:</p>
    <ul>
        <li><strong>Service Providers:</strong> We may share your data with third-party vendors or service providers who perform services on our behalf.</li>
        <li><strong>Legal Requirements:</strong> We may disclose your information to comply with legal obligations or court orders.</li>
        <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or asset sale, your personal data may be transferred.</li>
    </ul>

    <h3>4. Data Security</h3>
    <p>We implement reasonable security measures to protect your personal information. However, please be aware that no method of electronic transmission or storage is 100% secure.</p>

    <h3>5. Your Rights</h3>
    <p>You have the right to access, update, or delete your personal data. You can also withdraw your consent at any time where we rely on your consent to process your data.</p>

    <h3>6. Third-Party Links</h3>
    <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of those websites. Please review their privacy policies before providing any personal information.</p>

    <h3>7. Changes to This Privacy Policy</h3>
    <p>We may update our Privacy Policy from time to time. Any changes will be posted on this page, and the "Effective Date" will be updated accordingly.</p>

    <h3>8. Contact Us</h3>
    <p>If you have any questions or concerns about this Privacy Policy, please contact us at:</p>
    <ul>
        <li><strong>Email:</strong> [edinburghcinema@hotmail.com]</li>
        <li><strong>Address:</strong> [123 Cinema Street, Edinburgh, EH1 1AA, Scotland, UK]</li>
        <li><strong>Phone:</strong> [+44 131 123 4567]</li>
    </ul>
    <?php
    // Include the footer
    include('footer.php');
    ?>

</body>
</html>