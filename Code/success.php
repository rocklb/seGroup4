<?php

// start session
session_start();

// check if message 
if(!isset($_SESSION['success'])) {
    // redirect to login page 
    header("Location: login.php");
    exit();
}

// store and unset success message
$successMessage = $_SESSION['success'];
unset($_SESSION['success']);
?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

</head>

<body class="success-page">
    <div class="success-container">
        <h1>Success!</h1>
        <p><?= htmlspecialchars($successMessage); ?></p>
        <p>Redirecting to login page...</p>
    </div>

    <?php
    // pause 3 seconds before redirect
    sleep(3);
    header("Location: login.php");

    exit();
    ?>

</body>
</html>