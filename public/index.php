<?php
include '../src/functions.php'; // Include the file with the function

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['title'])) {
    addTodoItem($_POST['title']); // Call the function to add the TODO item
    header("Location: index.php"); // Redirect back to the index page
    exit();
}

// Get the database connection
$dbconn = getDbConnection(); // Call the function to establish a connection

// Fetch all todos
$result = pg_query($dbconn, "SELECT * FROM todos");
if (!$result) {
    die("Error in SQL query: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">TODO List</h1>

    <form action="" method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="title" class="form-control" placeholder="Add a new todo" required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </div>
    </form>

    <ul class="list-group">
        <?php while ($row = pg_fetch_assoc($result)): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo htmlspecialchars($row['title']); ?> 
                - <?php echo $row['completed'] ? 'Completed' : 'Not Completed'; ?>
                <a href="delete_todo.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
pg_close($dbconn);
?>
