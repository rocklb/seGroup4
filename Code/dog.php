<?php

session_start();

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// adding items to the cart
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product = [
        'name' => $_POST['product_name'],
        'price' => (float)$_POST['product_price'],
        'quantity' => 1,
        'image' => $_POST['product_image'],
    ];

    // check if prodcut in cart
    $exists = false;
    foreach($_SESSION['cart'] as &$cartItem) {
        if($cartItem['name'] === $product['name']) {
            $cartItem['quantity']++;
            $exists = true;
            break;
        }
    }

    //if does not exist add to cart
    if(!$exists) {
        $_SESSION['cart'][] = $product;
    }

    // redirect
    header('Location: dog.php');
    exit;
}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags for Responsiveness and Character Encoding -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Products - Waggles & More Pet Store</title>
    
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- Close Button -->
        <a href="javascript:void(0)" class="close-btn" onclick="toggleSidebar()">&times;</a>
        <!-- Sidebar Links -->
        <a href="dog.php">Dog</a>
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
                <a href="cart.php">Cart</a>
            </div>
        </div>

        <!-- Location Information -->
        <div class="location">
            <span>Your Store: San Antonio</span> | <span>Delivering to: 78213</span>
        </div>
    </header>

    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb">
        <a href="index.php">Home</a> &gt; <span>Dog Products</span>
    </div>

    <!-- Main Banner for Dog Category -->
    <section class="main-banner">
        <h2>Everything for Your Dog</h2>
        <button onclick="window.location.href='#dog-products'">Shop Dog Products</button>
    </section>

    <!-- Dog Products Section -->
    <section class="products" id="dog-products">
        <h2>Dog Products</h2>
        <div class="product-grid">
            <!-- Product Card 1 -->
            <!-- Dog food -->
            <form method="post" action="dog.php" class="product-card">
                <img src="images/dog/dog_food.jpg" alt="Premium Dog Food">
                <p>Premium Dog Food</p>
                <p class="product-price">$81.99</p>
                <input type="hidden" name="product_name" value="Premium Dog Food">
                <input type="hidden" name="product_price" value="81.99">
                
                <!-- product image go to cart -->
                <input type="hidden" name="product_image" value="images/dog/dog_food.jpg">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>

            <!-- Product Card 2 -->
            <form method="post" action="dog.php" class="product-card">
                <img src="images/dog/dog_toy.jpg" alt="Durable Dog Toy">
                <p>Durable Dog Toy</p>
                <p class="product-price">$12.99</p>
                <input type="hidden" name="product_name" value="Durable Dog Toy">
                <input type="hidden" name="product_price" value="12.99">

                <!-- product image go to cart -->
                <input type="hidden" name="product_image" value="images/dog/dog_toy.jpg">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>

            <!-- Product Card 3 -->
            <form method="post" action="dog.php" class="product-card">
                <img src="images/dog/dog_bed.jpg" alt="Comfortable Dog Bed">
                <p>Comfortable Dog Bed</p>
                <p class="product-price">$65.99</p>
                <input type="hidden" name="product_name" value="Comfortable Dog Bed">
                <input type="hidden" name="product_price" value="65.99">

                <!-- product image go to cart -->
                <input type="hidden" name="product_image" value="images/dog/dog_bed.jpg">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>

            <!-- Product Card 4 -->
            <form method="post" action="dog.php" class="product-card">
                <img src="images/dog/dog_leash.jpg" alt="Adjustable Dog Leash">
                <p>Adjustable Dog Leash</p>
                <p class="product-price">$8.99</p>
                <input type="hidden" name="product_name" value="Adjustable Dog Leash">
                <input type="hidden" name="product_price" value="8.99">


                <!-- product image go to cart -->
                <input type="hidden" name="product_image" value="images/dog/dog_leash.jpg">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
            <!-- Add More Product Cards as Needed -->
        </div>
    </section>

    <!-- JavaScript -->
    <script src="script.js"></script>
</body>
</html>