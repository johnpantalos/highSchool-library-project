<?php
session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }

// Database configuration
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Get user ID from URL
$id = $_GET['id'];

// Fetch user details
$sql = "SELECT * FROM Students WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit User</title>
        <link rel="stylesheet" href="../css/style.css">
        <script>
            function showPassword() {
                var x = document.getElementById("pwd");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </head>
    <body>
        <h2>Edit User</h2>
        <p>Change user's data</p>
        <form action="./users/edit_user_action.php?id=<?php echo $id;?>" class="universal-form" method="POST">
            <label for="name">Name: </label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            <label for="username">Username: </label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
            <label for="password">Password: </label>
            <input type="password" name="password" value="<?php echo $user['password']; ?>" id="pwd" required>
            <span><input type="checkbox" onclick="showPassword()"> Show Password</span>
            <input type="submit" value="Update">
        </form>
    </body>
</html>
