<?php

require 'functions.php';

session_start();



// error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// check if user is logged in
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}


// Process registration form 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // info from supabase
        $supabase = getSupabaseClient();

        // form inputs
        $first_name = htmlspecialchars(trim($_POST["first_name"]));
        $last_name = htmlspecialchars(trim($_POST["last_name"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // check if email exists
        $response = $supabase ->from('username') ->select('email') ->eq('email', $email) ->single();

        if(!empty($response['data'])) {
            // if email exist throw error
            $_SESSION['error'] = "Email already exists!";
            header("Location: registration.php");
            exit();
        }

        // insert new user to database
        $insertResponse = $supabase ->from('username') ->insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password
        ]);

        if(!isset($insertResponse['error'])) {
            $_SESSION['success'] = "Account created successfully! Please login.";
            header("Location: login.php");
            exit();
        }
        else {
            throw new Exception("Failed to register user. Please try again.");
        }
    } catch(Exception $e) {
        // log exceptions
        error_log($e->getMessage());
        $_SESSION['error'] = "An error occured. Please try again.";
        header("Location: registration.php");
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
        <h1>Create an Account</h1>

        <!-- error message -->
        <?php 
        if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?=htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Success message -->
        <?php 
        if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- registration form -->
        <form action="register.php" method="POST">
            <div class="mb-3">
                <!-- first name -->
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <!-- last name -->
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            
            <!-- email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <!-- password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn tbn-primary">Register</button>
            </div>
            <p class="mt-3">Already have an account? <a href="login.php">Log in here</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>