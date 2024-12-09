<?php

session_start();


// redirect if not looged in
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// diplay errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// welcome message
$username = $_SESSION['username'] ?? 'Guest';
?>

<!DOCtYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Waggles & More Pet Store</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">Account</a>
                    </li>
                    <li class="nav-item">
                        <a herf="logout.php" class="btn btn-danger">Logout</a>
                    </li>
                </ul>

            </div>
        </div>


    </nav>

    <!-- dashboard -->
    <div class="container dashboard-container">
        <!-- welcom -->
        <div class="welcome-banner">
            <h1>Welcome, <?= htmlspecialchars($username); ?>!</h1>
            <p>Manage your account and explore new features.</p>
        </div>

        
        <div class="row mt-5">
            <!-- Card 1: View Orders -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">View Orders</h5>
                        <p class="card-text">Check and manage all customer orders here.</p>
                        <a href="#" class="btn btn-primary">Go to Orders</a>
                    </div>
                </div>
            </div>

            <!--  Manage Products -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Products</h5>
                        <p class="card-text">Add, update, or remove products from your store.</p>
                        <a href="#" class="btn btn-primary">Go to Products</a>
                    </div>
                </div>
            </div>

            <!--  account Settings -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Account Settings</h5>
                        <p class="card-text">Update your personal information and preferences.</p>
                        <a href="account.php" class="btn btn-primary">Go to Settings</a>
                    </div>
                
                </div>
            </div>
        
        </div>
    </div>

   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>