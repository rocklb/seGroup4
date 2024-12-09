<?php
// Include functions file and start session
require 'functions.php';
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // get user input
        $first_name = htmlspecialchars(trim($_POST["first_name"]));
        $last_name = htmlspecialchars(trim($_POST["last_name"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $password = trim($_POST["password"]);

        // validate inputs
        if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: register.php");
            exit();
        }

        // hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //connect to sqlite database
        $db = getDBConnection();

        // check if the email already exists
        $stmt = $db->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();

        if ($result->fetchArray(SQLITE3_ASSOC)) {
            // Email already exists
            $_SESSION['error'] = "Email already exists. Please use a different email.";
            header("Location: register.php");
            exit();
        }

        // insert new user into the database
        $stmt = $db->prepare('INSERT INTO users (username, first_name, last_name, email, password) VALUES (:username, :first_name, :last_name, :email, :password)');
        $stmt->bindValue(':username', strtolower($first_name . $last_name), SQLITE3_TEXT);
        $stmt->bindValue(':first_name', $first_name, SQLITE3_TEXT);
        $stmt->bindValue(':last_name', $last_name, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);
        $stmt->execute();

        // redirect to login page with success message
        $_SESSION['success'] = "Account created successfully! Please log in.";
        header("Location: login.php");

        exit();
    } 
    
    catch (Exception $e) {
        // Log exception use to debug
        error_log("SQLlite registration exception: " . $e->getMessage());
        $_SESSION['error'] = "An error occurred during registration. Please try again.";
        header("Location: register.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pet Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="register-page">
    <div class="register-container">
        <h1 class="text-center">Register</h1>

        <!-- show error message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- success messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <!-- registration form -->
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="mt-3 text-center">Already have an account? <a href="login.php">Log in here</a>.</p>
        </form>
    </div>

</body>

</html>
