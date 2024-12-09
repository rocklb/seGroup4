<?php
// Function to connect to the  database
function getDBConnection() {
    // Path to sqlite database 
    // aadjust path if necessary
    $db = new SQLite3(__DIR__ . '/petstore.db'); 
    if (!$db) {
        throw new Exception("Failed to connect to the database.");
    }
    return $db;
}

// Function to authenticate user from the database
function authenticateUser($email, $password) {
    try {
        // connect to the database
        $db = getDBConnection();

        // prepare the query to get user email
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();

        // get user data
        $user = $result->fetchArray(SQLITE3_ASSOC);

        //verify password using php password_verify function
        if ($user && password_verify($password, $user['password'])) {
            
            // return user data on successful authentication
            return $user; 
        }

        // authentication failed
        return false; 
    } 

    catch (Exception $e) {
        // Log error for debugging
        error_log("SQLite authentication exception: " . $e->getMessage());

        return false;
    }
}


//function to get user info from database
function getUserInfo($username) {
    try {
        // connect to database
        $db = getDBConnection();

        //Prepare the sql query
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindValue('username', $username, SQLITE3_TEXT);
        $result = $stmt->execute();

        // get user data
        return $result->fetchArray(SQLITE3_ASSOC);
    }
    
    catch(Exception $e) {
        error_log("sqlite: ". $e->getMessage());
        return false;
    }
}

?>
