<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<head>
    <!-- External CSS links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg"> <!-- Custom styling from your CSS -->
        <a class="navbar-brand" href="adminPage.php">
            <img src="images/sustainability.png" alt="Logo" class="sustainability-logo" style="width: 95px; height: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text text-white mx-4" style="font-size: 18px;">
                        Hello, Admin
                        <img src="images/user.png" alt="Admin Icon" style="width: 22px; height: 22px; margin-left: 10px;" loading="lazy">
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn logout-btn" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Required JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>