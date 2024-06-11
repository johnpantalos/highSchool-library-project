<?php
session_start();

// Database configuration and connection
include "database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Check if the page has been reloaded
if (!isset($_SESSION['reloaded'])) 
{
    $_SESSION['reloaded'] = true;
    // Embed JavaScript to reload the page on load (helps showing the changes when edit users)
    echo '<script type="text/javascript">
        window.onload = function() {
            location.reload();
        };
    </script>';
} 
else 
{
    // Unset the session variable to avoid infinite loop
    unset($_SESSION['reloaded']);
}

// Fetch all Students
$sql = "SELECT * FROM Students";
$result_students = $conn->query($sql);

$id = intval($_GET['id']);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./css/style.css">
        <title>Admin Dashboard</title>
    </head>
    <body>
        <h2>Manage Users</h2>
        <!-- <a href="logout.php">Logout</a> -->
        <?php echo "<a href='register.php?id=" . $id . "'>Add New User</a>"; ?>
        
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result_students->num_rows > 0) {
                while($row = $result_students->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>
                                <a href='edit_user.php?id=" . $row['id']."'>Edit</a> | 
                                <a href='delete_user.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }
            ?>
        </table>
    </body>
</html>
