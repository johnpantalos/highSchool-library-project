<?php 

// Database configuration and connection
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Fetch all Books created
$sql = "SELECT * FROM BorrowRecords WHERE return_date='0000-00-00'";
$result_bor_books = $conn->query($sql);

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
        <title>Show Books</title>
    </head>
    <body>
        <div class="container_fluid">
            <table border='1' style='margin-left: auto; margin-right: auto; width: 100%;'>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Return?</th>
            </tr>
            <?php
                if ($result_bor_books->num_rows > 0) 
                { 
                    while($row = $result_bor_books->fetch_assoc()) { 
                
                        $st_id = $row['student_id']; 
                        $sql_student = "SELECT * FROM Students WHERE id='$st_id'";
                        $result_student = $conn->query($sql_student);
                        if($result_student->num_rows > 0) $student = $result_student->fetch_assoc();
                        
                        $book_id = $row['book_id'];
                        $sql_books = "SELECT * FROM Books WHERE id='$book_id'";
                        $result_books = $conn->query($sql_books);
                        if($result_books->num_rows > 0) $book = $result_books->fetch_assoc();
                        
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['student_id'] . "</td>
                                <td>" . $student['name'] . "</td>
                                <td>" . $row['book_id'] . "</td>
                                <td>" . $book['title'] . "</td>
                                <td>" . $row['borrow_date'] . "</td>
                                <td>" . $row['due_date'] . "</td>
                                <td>" . $row['return_date'] . "</td>
                                <td> <a href='./return_borrowed_book.php?id=" . $row['id'] . "'>Return Now</a> </td>
                            </tr>";
                    }
                } else {
                    echo "<p style='text-align: center; color: black;'>No Borrowed Books Found !</p>";
                }
                
                $conn->close();
            ?>
            </table>
        </div>
    </body>
</html>
<!-- DONE -->
