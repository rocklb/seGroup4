<?php

require 'functions.php';

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
        $first_name = 
    }
}