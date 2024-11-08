<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Database configuration and connection
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Get POST data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];
    $user_type = $_POST['user_type'];
}

// Check if passwords match
if ($password !== $confirm_password) 
{
    // echo "Passwords do not match. Please try again.";
    echo '<script>alert("Passwords do not match. Please try again !");</script>';
    echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
}
else 
{
    if($user_type === 'admin')
    {
        // Check if this username already exists in Students table
        $sql_check = "SELECT * from students WHERE username='$username';";
        $result_students = $conn->query($sql_check);
        $students = $result_students->fetch_assoc();
        // print_r($students);
        if($result_students->num_rows < 1)
        {
            // Insert user into the database
            $sql = "INSERT INTO admins (name, username, password) VALUES ('$name','$username', '$password')";

            if ($conn->query($sql) === TRUE) 
            {
                // echo "<p style='text-align: center; color: black;'>Admin registered successfully !</p>";
                echo '<script>alert("Admin registered successfully !");</script>';
                echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
                exit();
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else
        {
            // echo "User already exists in Students table.";
            echo '<script>alert("User already exists in Students table !");</script>';
            echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
        }

    }
    else if($user_type === 'student') 
    {
        // Check if this username already exists in Admins table
        $sql_check = "SELECT * from admins WHERE username='$username';";
        $result_students = $conn->query($sql_check);

        if($result_students->num_rows === 0)
        {
            // Insert user into the database
            $sql = "INSERT INTO students (name, username, password) VALUES ('$name','$username', '$password')";
            
            if ($conn->query($sql) === TRUE) 
            {
                // echo '<p style"text-align: center; color: black">Student registered successfully !</p>';
                echo '<script>alert("Student registered successfully !");</script>';
                // Redirected one page back 
                echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
                exit();
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else 
        {
            // echo "User already exists in Admins table.";
            echo '<script>alert("User already exists in Admins table !");</script>';
            echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
        }
    }
}

$conn->close();

exit();
?>
