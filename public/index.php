<?php
include '../src/db.php'; // Include the database connection logic

// Get the database connection
$dbconn = getDbConnection(); // Call the function to establish a connection

// Fetch all todos
$result = pg_query($dbconn, "SELECT * FROM todos");
if (!$result) {
    die("Error in SQL query: " . pg_last_error());
}

// Display the TODO list and the form
echo "<h1>TODO List</h1>";

// Add TODO form
echo '<form action="add_todo.php" method="POST">
        <input type="text" name="title" placeholder="Add a new todo" required>
        <button type="submit">Add</button>
      </form>';

echo "<ul>";
while ($row = pg_fetch_assoc($result)) {
    echo "<li>" . htmlspecialchars($row['title']) . " - " . ($row['completed'] ? 'Completed' : 'Not Completed') . "</li>";
}
echo "</ul>";

// Close the database connection
pg_close($dbconn);
?>
