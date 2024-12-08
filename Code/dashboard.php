<?php




<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" contenet="width=device-width, initial-scale=1.0">

    <!-- title desplayed in browswer -->
    <title>Dashboard - Pet Store</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- header navigation bar -->
    <header>
        <div class="navbar">
            <div class="logo">
                <h1>Pet Store</h1>
            </div>

            <!-- Placeholder to push navigation links to the right -->
            <div style="flex: 1;"></div>
            <!-- Navigation links -->
            <div class="nav-links">
                <!-- Logout button -->
                <a href="#" id="logout">Logout</a>
            </div>
        </div>
    </header>

    <!-- Main content of page -->
     <main>
        <!-- welcome mesasge -->
         <h1>Welcome to your Dashboard</h1>
         <p>Manage your account, browse products, or check your orders below:</p>

         <!-- Links -->
        <div class="link-card">
            <h3><a herf="cart.html">Your Cart</a></h3>
            <p>VIew and Manage your items in cart.</p>    
        </div>

        <div class="link-card">
            <h3><a herf="orders.html">Your Orders</a></h3>
        </div>
     </main>
</body>
</html>