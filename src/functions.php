<?php
include 'db.php'; // Include the database connection logic

function addTodoItem($title) {
    // Get the database connection
    $dbconn = getDbConnection();

    // Escape user input to prevent SQL injection
    $title = pg_escape_string($dbconn, $title);
    
    // Prepare the SQL query
    $query = "INSERT INTO todos (title) VALUES ('$title')";
    $result = pg_query($dbconn, $query);
    
    // Check if the query was successful
    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }

    // Close the database connection
    pg_close($dbconn);
}
?>
