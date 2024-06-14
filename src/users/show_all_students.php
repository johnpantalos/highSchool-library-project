<?php 
    session_start();

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname
    if (!isset($_SESSION['first_load'])) {
        // This is the first load
        $_SESSION['first_load'] = true;
        
        // Reload the page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    
    // Fetch all Students
    $sql = "SELECT * FROM Students";
    $result_students = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <style type="text/css">
            html {
                background-image: none;
            }
        </style>
        <title>Show Students</title>
    </head>
    <body>
        <div class="container_fluid">
            <table border="1" style="margin-left: auto; margin-right: auto; width: 100%;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
                if ($result_students->num_rows > 0) {
                    while($row = $result_students->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>
                                    <a href='./edit_user.php?id=" . $row['id']."'>Edit</a> | 
                                    <a href='./delete_user.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<p style='text-align: center;'>No students found !</p>";
                }
                
                $conn->close();
            ?>
            </table>
        </div>
    </body>
</html>
<!-- DONE -->
