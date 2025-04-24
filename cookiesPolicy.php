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
    <title>Cookies Policy</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <h1>Cookies Policy</h1>

    <p><strong>Effective Date:</strong> [18/12/2024]</p>

    <p>At Edinburgh Cinema, we use cookies to improve your experience on our website. This Cookies Policy explains what cookies are, how we use them, and your choices regarding cookies.</p>

    <h2>1. What Are Cookies?</h2>
    <p>Cookies are small text files that are stored on your device when you visit a website. They allow the website to remember your preferences and actions over time. Cookies may be "persistent" (remaining on your device for a specified period) or "session" (lasting only for the duration of your visit).</p>

    <h2>2. How We Use Cookies</h2>
    <p>We use cookies for the following purposes:</p>
    <ul>
        <li><strong>Essential Cookies:</strong> These cookies are necessary for the functioning of our website, such as enabling you to navigate the site and access secure areas.</li>
        <li><strong>Performance Cookies:</strong> These cookies help us analyze website traffic and improve user experience.</li>
        <li><strong>Functionality Cookies:</strong> These cookies allow us to remember your preferences and provide a more personalized experience.</li>
        <li><strong>Advertising Cookies:</strong> We may use cookies to display targeted advertisements to users based on their behavior on our website.</li>
    </ul>

    <h2>3. Managing Cookies</h2>
    <p>You can manage your cookie preferences by adjusting the settings in your browser. Most browsers allow you to refuse or accept cookies. However, please note that if you disable cookies, some features of our website may not work properly.</p>

    <ul>
        <li><strong>Google Chrome:</strong> How to manage cookies in Chrome</li>
        <li><strong>Mozilla Firefox:</strong> How to manage cookies in Firefox</li>
        <li><strong>Microsoft Edge:</strong> How to manage cookies in Edge</li>
    </ul>

    <h2>4. Third-Party Cookies</h2>
    <p>We may use third-party services (e.g., Google Analytics) that use cookies to collect information about your behavior on our website. These cookies are subject to the respective privacy policies of those third parties.</p>

    <h2>5. Changes to This Cookies Policy</h2>
    <p>We may update this Cookies Policy from time to time. Any changes will be posted on this page, and the "Effective Date" will be updated accordingly.</p>

    <h2>6. Contact Us</h2>
    <p>If you have any questions or concerns about this Cookies Policy, please contact us at:</p>
    <ul>
        <li><strong>Email:</strong> contact@edinburghcinema.com</li>
        <li><strong>Address:</strong> 123 Cinema Street, Edinburgh, EH1 1AA, Scotland, UK</li>
        <li><strong>Phone:</strong> +44 131 123 4567</li>
    </ul>
    <?php
    // Include the footer
    include('footer.php');
    ?>
</body>
</html>