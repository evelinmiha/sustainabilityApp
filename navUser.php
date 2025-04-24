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
    <nav class="navbar navbar-expand-lg"> <!-- Added bg-success and navbar-dark -->
        <a class="navbar-brand" href="home.php">
            <img src="images/sustainability.png" alt="Logo" class="sustainability-logo" style="width: 95px; height: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if($current_page == 'home.php') echo 'active'; ?>">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item <?php if($current_page == 'description.php') echo 'active'; ?>">
                    <a class="nav-link" href="description.php">Description</a>
                </li>
                <li class="nav-item <?php if($current_page == 'information.php') echo 'active'; ?>">
                    <a class="nav-link" href="information.php">Information</a>
                </li>
                <li class="nav-item <?php if($current_page == 'pointsGatheringPage.php') echo 'active'; ?>">
                    <a class="nav-link" href="pointsGatheringPage.php">Points Gathering</a>
                </li>
                <li class="nav-item <?php if($current_page == 'greenCalculator.php') echo 'active'; ?>">
                    <a class="nav-link" href="greenCalculator.php">Rubric Green Calculator</a>
                </li>
                <li class="nav-item <?php if($current_page == 'user_account.php') echo 'active'; ?>">
                    <a class="nav-link" href="user_account.php">User Account</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text text-white mx-4" style="font-size: 18px;">
                        Hello, <?php echo htmlspecialchars($_SESSION['company_name']); ?>
                        <img src="images/user.png" alt="User Icon" style="width: 22px; height: 22px; margin-left: 10px;" loading="lazy">
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn logout-btn" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- ✅ REQUIRED JS: jQuery + Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
