<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../users/login.php");
        exit();
    }

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        // Get POST data
        $title = $_POST['title'];
        $author = $_POST['author'];
        $copies_available = $_POST['copies_available'];
    }

    // Insert user into the database
    $sql = "INSERT INTO books (title, author, copies_available) VALUES ('$title', '$author' , '$copies_available')";

    if ($conn->query($sql) === TRUE) 
    {
        echo '<script>alert("Book registered successfully !");</script>';
        // Redirect one page back
        echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
        // echo "Book successfully registered !";
        exit();
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    exit();
?>
