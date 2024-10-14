<?php

function getDbConnection() {
    $host = 'localhost';
    $port = '5432';
    $dbname = 'todoapp';
    $user = 'andrewnjoo';
    $password = ''; // Add your password if needed

    $conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
    $dbconn = pg_connect($conn_string);

    if (!$dbconn) {
        $error = "Error in connection: " . pg_last_error();
        error_log($error, 3, '../logs/db_connection.log'); // Log the error
        die($error); // Display the error
    }
    
    return $dbconn;
}
