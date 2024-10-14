<?php
session_start();
include '../src/functions.php';
include 'header.php'; // Include the head section

// Handle POST requests for adding or editing TODO items
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    handlePostRequest();
    header("Location: index.php");
    exit();
}

$dbconn = getDbConnection();
$todos = fetchAllTodos($dbconn);
pg_close($dbconn);

// Helper Functions
function handlePostRequest()
{
    if (!empty($_POST['title'])) {
        addTodoItem($_POST['title']);
    } elseif (isset($_POST['edit_id'], $_POST['edit_title'])) {
        updateTodoItem((int)$_POST['edit_id'], $_POST['edit_title']);
    }
}

function updateTodoItem($id, $title)
{
    $db = getDbConnection();
    $sanitizedTitle = pg_escape_string($db, $title);
    $query = "UPDATE todos SET title = '$sanitizedTitle' WHERE id = $id";
    $result = pg_query($db, $query);
    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }
}

function fetchAllTodos($db)
{
    $result = pg_query($db, "SELECT * FROM todos");
    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

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
            <?php while ($row = pg_fetch_assoc($todos)): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="todo-display">
                        <span class="todo-title" id="title-<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </span>
                        <button class="btn btn-warning btn-sm" onclick="toggleEditForm(<?php echo $row['id']; ?>, true)">Edit</button>
                        <a href="delete_todo.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirmDelete();">Delete</a>
                    </div>

                    <form action="" method="POST" class="edit-form" id="edit-form-<?php echo $row['id']; ?>" style="display: none;">
                        <input type="text" name="edit_title" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm(<?php echo $row['id']; ?>, false)">Cancel</button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this item?');
        }

        function toggleEditForm(id, show) {
            const displayElements = document.querySelectorAll('.todo-display');
            const editForm = document.getElementById(`edit-form-${id}`);

            displayElements.forEach(el => el.classList.toggle('d-none', show));
            editForm.style.display = show ? 'flex' : 'none';
        }
    </script>
</body>

</html>