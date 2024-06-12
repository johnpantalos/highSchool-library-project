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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update user details
    $sql = "UPDATE Students SET username='$username', password='$password' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        
        // Redirect using JavaScript to go back 2 pages
        echo '<script type="text/javascript"> window.history.go(-2); </script>';
        exit();
    } else {
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
    <form action="" method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        <label for="password">Password: </label>
        <input type="password" name="password" value="<?php echo $user['password']; ?>" id="pwd" required><br>
        <input type="checkbox" onclick="showPassword()">Show Password
        <input type="submit" value="Update">
    </form>
</body>
</html>
