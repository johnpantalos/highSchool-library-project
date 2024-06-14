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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update user details
    $sql = "UPDATE Students SET name='$name', username='$username', password='$password' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) 
    {
        echo "<p style='text-align: center; color: black;'>Account changed successfully !</p>";
        exit();
    } 
    else 
    {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
        html{
            background-image: none;
        }
        body h2, body p{
            color: black;
        }

    </style>
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
<div class="container-big-2 orange_bg">
    <h2>Edit User</h2>
    
    <p>Change user's data</p>
    <form action="" class="edit-user-form-by-student" method="POST">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <label for="username">Username: </label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <label for="password">Password: </label>
        <input type="password" name="password" value="<?php echo $user['password']; ?>" id="pwd" required>
        <span><input type="checkbox" onclick="showPassword()"> Show Password</span>
        <input type="submit" value="Update">
    </form>
</div>

</body>
</html>
