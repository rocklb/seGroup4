<?php

session_start();
require 'functions.php';

// redirect if not logged in
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// get user info from database
$username = $_SESSION['username'];
$user = getUserInfo($username);

if(!$user) {
    // if user info not found send back to login 
    $_SESSION['error'] = "User not found. Please log in.";

    header("Location: login.php");
    exit();

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="account-page">
    <div class="account-container">
        <h1>Account Settings</h1>

        <!-- user info -->
        <div class="user-info">
            <p><strong>Username:</strong> <?=htmlspecialchars($user['username']); ?></p>
            <p><strong>First Name:</strong> <?=htmlspecialchars($user['first_name']); ?></p>
            <p><strong>Last Name:</strong> <?=htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Email:</strong> <?=htmlspecialchars($user['email']); ?></p>
        </div>


        <!-- action button -->
        <div class="action-buttons mt-3">
            <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>