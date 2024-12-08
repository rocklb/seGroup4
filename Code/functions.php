<?php
require 'vendor/autoload.php';


use Supabase\CreateClient;

function authenticateUser($username, $password) {
    $SUPABASE_URL = 'https://mktewrgkuekhwtnwsgwq.supabase.co';
    $SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im1rdGV3cmdrdWVraHd0bndzZ3dxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzMzMzEwMjAsImV4cCI6MjA0ODkwNzAyMH0.YC8tpl2P9P2EftqU3dGXHmDpUBTG0FZHK7K2PZ4qoKU';

    // initialize supabase client
    $supabase = CreateClient::create($SUPABASE_URL, $SUPABASE_KEY);

    try {
        $response = $supabase-> from('users') ->select('*') ->eq('username', $username) ->single();

        // check if the user exists
        if(isset($response['data']) && $response['data'] !== null) {
            $user = $response['data'];

            // verify password using php 
            if(password_verify($password, $user['password'])) {
                // successful
                return $user;
            }
        }

        // return false if failed
        return false;
    } catch(Exception $e) {
        // log error 
        error_log("Supabase error: ". $e->getMessage());
        return false;
    }

}
?>