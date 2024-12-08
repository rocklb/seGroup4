<?php

// start session
session_start();


include 'functions.php';

// check if user is already logged in
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}


// Check for success message 
$successMessage = null;
if(isset($_SESSION['success'])) {
    $successMessage = $_SESSION['success'];
    unset($_SESSION['success']);
}

// handle login form 
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // validate form input
    if(empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    }
    else {
        $user = authenticateUser($username, $password);

        if($user) {
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        }
        else {
            $error = "invalid username or password.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pet Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>


<body class="login-page"> 
    <div class="login-container">
        <h1>Login</h1>

        <!-- success message -->
        <?php
        if(!empty($successMessage)): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($successMessage); ?>
            </div> 
        <?php endif; ?>

        <!-- error login failed -->
        <?php 
            if(!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?=htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- login form --> 
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</lable>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>


        <!-- Registraion link -->
        <p>
            Don't have an account? <a href="register.php">Register here</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>