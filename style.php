<?php
header("Content-type: text/css; charset=UTF-8");
?>
/* Reset & Base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #F2F7EC !important;
    color: #333;
    font-family: 'Lato', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    letter-spacing: 0.3px;
    font-weight: 400;
    scroll-behavior: smooth;
}
.bg-custom {
    background-color: #F2F7EC !important;
}

/* Typography */
h1, h2 {
    color: #2C5E1A;
    font-family: 'Merriweather', serif;
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 15px;
}

h3, h4 {
    color: #4A752C;
    font-family: 'Merriweather', serif;
    font-size: 22px;
}

/* Buttons */
.btn {
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    font-weight: bold;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: white;
    background-color: #1E7A3B;
    padding: 12px 24px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
    text-decoration: none;
    border: none;
}
.btn:hover {
    background-color: #16632E;
}
.logout-btn {
    box-shadow: none;
    outline: none;
}

/* Hero Layout */
.hero, .information-hero, .description-hero {
    background-position: center;
    background-size: cover;
    position: relative;
    color: white;
    text-align: center;
    padding: 100px 20px;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.hero {
    background-image: url('sustain.jpeg');
}

.information-hero {
    background-image: url('images/green_calculator.png'); 
}

.hero::before,
.description-hero::before,
.information-hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.information-hero::before {
    background: rgba(0, 0, 0, 0.7);
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    text-align: center;
}

.hero h1, .hero p,
.description-hero h1, .description-hero p,
.information-hero h1, .information-hero p {
    color: #fff;
    text-shadow: 0 2px 4px rgba(0,0,0,0.6);
}

/* Containers & Sections */
.container {
    background: #fdfdf8;
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.05);
}
.container ul {
    list-style: none;
    padding: 0;
}
.container li {
    font-size: 18px;
    margin: 10px 0;
}

/* Footer */
footer {
    background-color: #2C3E50;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 14px;
}
footer a {
    color: #FFD700;
    text-decoration: none;
}
footer a:hover {
    color: #F2F2F2;
}

/* Reasons Grid */
.reasons-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}
.reason {
    background: white;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    flex: 1 1 300px;
}
.reason img {
    width: 100%;
    border-radius: 10px;
}

/* Promo & Vouchers */
.promo-section {
    background: #f9f9f9;
    padding: 50px 20px;
    text-align: center;
}

.voucher-display {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}
.voucher-img {
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.voucher-icon {
    width: 200px;
    height: auto;
    margin-top: 10px;
}
.voucher-caption {
    font-size: 18px;
    color: #333;
    max-width: 600px;
    text-align: center;
    line-height: 1.4;
}

.promo-gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
}
.promo-gallery img {
    width: 100%;
    max-width: 300px;
}

/* Partner + CTA */
.unesco-partner,
.cta {
    background: #1E7A3B;
    color: white;
    padding: 50px;
    text-align: center;
}
.unesco-partner a {
    background-color: #FFD700;
    color: black;
}

/* Navbar */
.navbar {
    background-color: #1E3D2F;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    position: sticky;
    top: 0;
    z-index: 1000;
    border-radius: 0 0 12px 12px;
}
.navbar a {
    color: white;
    text-decoration: none;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}
.navbar a:hover {
    color: #A9DFBF;
}
.navbar-nav .active > .nav-link {
    color: #A9DFBF !important;
    font-weight: bold;
    border-bottom: 2px solid #A9DFBF;
}
.navbar-toggler {
    border: 1px solid #1aff66;
    background-color: transparent;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.navbar-toggler-icon {
    background-color: white;
    width: 30px;
    height: 20px;
}
.cinema-logo {
    width: 50px;
    height: auto;
}

/* Responsive */
@media (max-width: 768px) {
    .hero, .information-hero, .description-hero {
        padding: 60px 20px;
        height: auto;
    }
}