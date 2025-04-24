<?php
// Get the current page
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header>    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Popper.js (Required for Bootstrap dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg"> <!-- Keep navbar-dark and bg-dark classes for styling -->
        <!-- Logo ( Icon) instead of text -->
        <a class="navbar-brand" href="home.php">
            <img src="images/sustainability.png" alt="Logo" class="cinema-logo"> <!-- Add class 'cinema-logo' -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Home -->
                <li class="nav-item <?php if($current_page == 'home.php') echo 'active'; ?>">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <!-- Description -->
                <li class="nav-item <?php if($current_page == 'showingNow.php') echo 'active'; ?>">
                    <a class="nav-link" href="description.php">Description</a>
                </li>
                <!-- Information -->
                <li class="nav-item <?php if($current_page == 'comingSoon.php') echo 'active'; ?>">
                    <a class="nav-link" href="information.php">Information</a>
                </li>
                <!-- User Account -->
                <li class="nav-item <?php if($current_page == 'user_account.php') echo 'active'; ?>">
                    <a class="nav-link" href="login.php">Subscription/Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>