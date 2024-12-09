<?php

session_start();

// Destory session data
session_unset();
session_destroy();

// send back to login page
header("Location: index.php");
exit();

?>