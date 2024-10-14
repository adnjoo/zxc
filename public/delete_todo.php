<?php
include '../src/db.php'; // Include the database connection logic

// Get the database connection
$dbconn = getDbConnection();

// Check if the ID parameter is present
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Cast the ID to an integer for safety

    // Prepare the SQL query to delete the TODO item
    $query = "DELETE FROM todos WHERE id = $id";
    $result = pg_query($dbconn, $query);

    // Check if the query was successful
    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }

    // Redirect back to the index page after deletion
    header("Location: index.php");
    exit();
}

// Close the database connection
pg_close($dbconn);
?>
