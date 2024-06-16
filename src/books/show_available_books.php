<?php 

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

    // Fetch all Books created
    $sql = "SELECT * FROM Books";
    $sql = "SELECT * FROM Books ORDER BY id";
    $result_books = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <title>Show Books</title>
    </head>
    <body>
        <h4>Here is the list of Available Books : </h4><br>

        <table border='1' style='margin-left: auto; margin-right: auto; width: 100%;'>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Copies Available</th>
        </tr>
        <?php
            if ($result_books->num_rows > 0) 
            { 
                while($row = $result_books->fetch_assoc()) 
                { 
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['author'] . "</td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['copies_available'] . "</td>
                        </tr>";
                }
            } 
            else 
            {
                echo "<p style='text-align: center; color: black;'>No Books Found !</p>";
            }
            
            $conn->close();
        ?>
        </table>
    </body>
</html>
