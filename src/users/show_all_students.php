<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../users/login.php");
        exit();
    }

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname
    
    // Fetch all Students
    $sql = "SELECT * FROM Students";
    $result_students = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <title>Show Students</title>
    </head>
    <body>
        <h4>Here is the list of the Students : </h4><br>
        <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
        <?php
            if ($result_students->num_rows > 0) {
                while($row = $result_students->fetch_assoc()) 
                {
                    $url = "./users/edit_user.php?id=" . $row['id'];
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>
                        ";
                        ?>
                        
                        <button class='table-button' onclick="loadContent('<?php echo $url;?>');">Edit</button> |
                        
                        <?php echo "
                        <a href='./users/delete_user.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<p style='text-align: center; color: black;'>No students found !</p>";
            }
            
            $conn->close();
        ?>
        </table>
    </body>
</html>
