<?php

session_start();

// Destory session data
session_unset();
session_destory();

// send back to login page
header("Location: login.php");
exit();

?>