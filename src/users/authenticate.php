<?php
session_start();

// Database configuration and connection
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = '';

    // Check in admins table
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        $role = 'admin';
    } else {
        // Check in students table
        $stmt = $conn->prepare("SELECT id, password FROM students WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            $role = 'student';
        }
    }

    if ($role !== '') {
        if ($password === $hashed_password) {
            // Password is correct
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            if ($role === 'student') {
                header("Location: ../student_dashboard.php");
            } else if ($role === 'admin') {
                header("Location: ../admin_dashboard.php");
            }
            exit();
        } else {
            // echo "Invalid username or password.";
            echo '<script>alert("Invalid username or password !");</script>';
            echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
        }
    } else {
        // echo "Invalid username or password.";
        echo '<script>alert("Invalid username or password !");</script>';
        echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
    }

    $stmt->close();
}
$conn->close();
?>
