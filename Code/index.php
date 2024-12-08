<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="close-btn" onclick="toggleSidebar()">&times;</a>
        

        <a href="dog.html">Dog</a>
        <a href="cat.html">Cat</a>
        <a href="fish.html">Fish</a>
        <a href="small_pet.html">Small Pet</a>
    </div>

    <!-- Header Section -->
    <header>
        <div class="navbar">
            <!-- Menu Icon -->
            <div class="menu-icon" onclick="toggleSidebar()">
                &#9776;
            </div>
            <!-- Website Name -->
            <div class="logo">
                <h1>Pet Store</h1>
            </div>
            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" placeholder="Search...">
            </div>
            <!-- Account and Cart Links -->
            <div class="nav-links">
                <a href="login.php">Account</a>
                <a href="cart.html">Cart</a>
            </div>
        </div>
        <div class="location">
            <span>Your Store: San Antonio</span> | <span>Delivering to: 78213</span>
        </div>
    </header>

    <!-- Main Banner -->
    <section class="main-banner">
        <h2>$7 DOG AND CAT HALLOWEEN COSTUMES</h2>
        <button>Shop Now</button>
    </section>

    <!-- Quick Links -->
    <section class="quick-links">
        <div class="quick-link">
            <h3><a href=login.php>Sign In</a></h3>
            <p>To earn rewards, savings, offers and more</p>
        </div>
        <div class="quick-link">
            <h3>Save 35%</h3>
            <p>On your first Repeat Delivery order</p>
        </div>
        <div class="quick-link">
            <h3>Save with Premier</h3>
            <p>Save up to $350/year.</p>
        </div>
        <div class="quick-link">
            <h3>Book Grooming</h3>
            <p>Same-day appointments available!</p>
        </div>
    </section>

    <!-- Product Section -->
    <section class="products">
        <h2>Top Sellers</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="images/product1.jpg" alt="Product Image">
                <p>Purina Pro Plan Sensitive Skin and Stomach Salmon...</p>
            </div>
            <div class="product-card">
                <img src="images/product2.jpg" alt="Product Image">
                <p>Taste of the Wild High Prairie Grain-Free Roasted...</p>
            </div>
            <div class="product-card">
                <img src="images/product3.jpg" alt="Product Image">
                <p>Dr. Elsey's Ultra Clumping Multi-Cat Litter, 40 lb...</p>
            </div>
            <div class="product-card">
                <img src="images/product4.jpg" alt="Product Image">
                <p>Seresto Vet-Recommended Flea & Tick Collar for Dogs...</p>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="script.js"></script>
</body>
</html>
