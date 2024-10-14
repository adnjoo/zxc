<?php
// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't been started already
}

// Include the database connection logic
include '../src/db.php'; 

function addTodoItem($title) {
    // Get the database connection
    $dbconn = getDbConnection();
    $title = pg_escape_string($dbconn, $title);
    $query = "INSERT INTO todos (title) VALUES ('$title')";
    $result = pg_query($dbconn, $query);
    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }
    pg_close($dbconn);
}
