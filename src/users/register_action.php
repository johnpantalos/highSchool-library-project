<?php

// Database configuration and connection
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Get POST data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];
    $user_type = $_POST['user_type'];
}

// Check if passwords match
if ($password !== $confirm_password) 
{
    echo "Passwords do not match. Please try again.";
}
else 
{
    if($user_type === 'admin')
    {
        // Check if this username already exists in Students table
        $sql_check = "SELECT * from Students WHERE username='$username';";
        $result_students = $conn->query($sql_check);

        if($result_students->num_rows == 0)
        {
            // Insert user into the database
            $sql = "INSERT INTO Admins (username, password) VALUES ('$username', '$password')";

            if ($conn->query($sql) === TRUE) 
            {
                // Redirect two pages back
                echo '<script language="JavaScript" type="text/javascript">history.go(-2);</script>';
                exit();
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else
        {
            echo "User already exists in Students table.";
        }

    }
    else if($user_type === 'student') 
    {
        // Check if this username already exists in Admins table
        $sql_check = "SELECT * from Admins WHERE username='$username';";
        $result_students = $conn->query($sql_check);

        if($result_students->num_rows == 0)
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') $name = $_POST['name'];
            // Insert user into the database
            $sql = "INSERT INTO Students (name, username, password) VALUES ('$name','$username', '$password')";
            
            if ($conn->query($sql) === TRUE) 
            {
                // Redirect two pages back
                echo '<script language="JavaScript" type="text/javascript">history.go(-2);</script>';
                exit();
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else 
        {
            echo "User already exists in Admins table.";
        }
    }
}

$conn->close();

exit();
?>
