<?php
session_start();

// Include the correct navigation bar
if (isset($_SESSION['company_id'])) {
    include('navUser.php');  // Logged-in nav
} else {
    include('nav.php');      // Guest nav
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback - Sustainability Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>

<div class="container feedback-page">
    <h1>Send Us Your Feedback</h1>
    <p>We appreciate your thoughts, questions, and suggestions. Use the form below to get in touch with the site administrator.</p>

    <form id="feedback_form" method="post" action="processFeedback.php">
        <!-- Name -->
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required maxlength="100">
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required maxlength="100" placeholder="name@example.com">
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Contact Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" required maxlength="15" placeholder="e.g. 07700111222">
        </div>

        <!-- Message / Comments -->
        <div class="form-group">
            <label for="comments">Your Comments / Feedback</label>
            <textarea class="form-control" id="comments" name="comments" rows="6" required placeholder="Write your message here..."></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success mt-3">Submit Feedback</button>
    </form>
</div>

<?php
// Include footer
include('footer.php');
?>

</body>
</html>