<?php
include '../src/db.php'; // Adjust the path as necessary

// Get the database connection
$dbconn = getDbConnection();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['title'])) {
    // Escape user input to prevent SQL injection
    $title = pg_escape_string($dbconn, $_POST['title']);
    
    // Prepare the SQL query
    $query = "INSERT INTO todos (title) VALUES ('$title')";
    $result = pg_query($dbconn, $query);
    
    // Check if the query was successful
    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }

    // Redirect back to the index page
    header("Location: index.php");
    exit();
}

// Close the database connection
pg_close($dbconn);
?>
