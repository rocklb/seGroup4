<?php

session_start();

// initialize cart
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// clear cart
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_cart'])) {
    //empty cart
    $_SESSION['cart'] = [];
}




// remove one item at a time from cart
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    // get item from index from post 
    $itemIndex = $_POST['item_index'];

    if(isset($_SESSION['cart'][$itemIndex])) {
        // reduce quantity by 1
        $_SESSION['cart'][$itemIndex]['quantity']--;
        if($_SESSION['cart'][$itemIndex]['quantity'] <= 0) {
            // if quantity is 0 remove item from cart
            unset($_SESSION['cart'][$itemIndex]);
            // reindex cart array 
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

    
    }
}





// adding items to cart
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product = [
        'name' => $_POST['product_name'],
        'price' => (float)$_POST['product_price'],
        'quantity' => 1,
        'image' => $_POST['product_image'],
    ];

    //check if product is in cart
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
}

//calculate totals
$totalItems = 0;
$totalPrice = 0.0;
foreach($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
    $totalPrice += $item['price'] * $item['quantity'];
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags for Responsiveness and Character Encoding -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Waggles & More Pet Store</title>
    
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
            <!-- Placeholder for Alignment -->
            <div style="flex: 1;"></div>
            <!-- Navigation Links -->
            <div class="nav-links">
                <a href="login.php">Account</a>
            </div>
        </div>
    </header>

    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb">
        <a href="index.php">Home</a> &gt; <span>Shopping Cart</span>
    </div>

    <!-- Cart Section -->
    <section class="cart-section">
        <h2>Your Shopping Cart</h2>
        <div class="cart-items">
            <?php if(empty($_SESSION['cart'])): ?>
                <p>Your cart is empty</p>
            <?php else: ?>
                <?php foreach($_SESSION['cart'] as $index => $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 100px; height: auto:"> 
                        <p><strong><?php echo htmlspecialchars($item['name']); ?></strong></p>
                        <p>Price: $<?php echo number_format($item['price'], 2); ?> | Quantity: <?php echo $item['quantity']; ?></p>
                        <p>Subtotal: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p> 
                    </div>

                    <!-- remove button -->
                    <form method="post" class="remove-item-form">
                        <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                        <button type="submit" name="remove_item" class="remove-item-btn">Remove</button>
                    </form>
                    
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Cart summbary -->
        <div class="cart-summary">
            <p>Total Items: <span id="total-items"><?php echo $totalItems; ?></span></p>
            <p>Total Price: $<span id="total-price"><?php echo number_format($totalPrice, 2); ?></span></p>
            <?php if(!empty($_SESSION['cart'])): ?>
                <form method="post">
                    <button type="submit" name="clear_cart" class="clear-cart-btn">Clear Cart</button>
                </form>
            <?php endif; ?>

            <!-- checkout button -->
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </section>
</body>
</html>
