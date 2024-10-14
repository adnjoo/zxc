<?php

include '../src/db.php'; // Adjust the path as necessary

$dbconn = getDbConnection();

// Read SQL file
$sql = file_get_contents('migrations.sql');

// Execute SQL commands
$result = pg_query($dbconn, $sql);
if (!$result) {
    die("Error in SQL execution: " . pg_last_error());
}

echo "Migrations executed successfully.\n";

// Close the database connection
pg_close($dbconn);
?>
