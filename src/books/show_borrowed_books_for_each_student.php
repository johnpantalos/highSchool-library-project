<?php 

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname
    
    $id = intval($_GET['id']);
    
    // Fetch all Books created
    $sql = "SELECT * FROM BorrowRecords WHERE student_id ='$id' AND return_date = '0000-00-00'";
    $result_bor_books_specific_student = $conn->query($sql);

?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <style type="text/css"> html { background-image: none; } </style>
        <title>Show Books</title>
    </head>
    <body>
        <h4>Here is the list of the Borrowed Books : </h4><br>
        <table border='1'>
            <tr>
                <th>Record ID</th>
                <th>Student ID</th>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Return?</th>
            </tr>
            <?php
                if ($result_bor_books_specific_student->num_rows > 0) 
                { 
                    while($row = $result_bor_books_specific_student->fetch_assoc()) 
                    { 
                        $url = "./books/return_borrowed_book.php?id=" . $row['id'];
                        $book_id = $row['book_id'];
                        
                        $sql_books = "SELECT * FROM Books WHERE id='$book_id'";
                        $result_books = $conn->query($sql_books);
                        if($result_books->num_rows > 0) $book = $result_books->fetch_assoc();
                        
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['student_id'] . "</td>
                                <td>" . $row['book_id'] . "</td>
                                <td>" . $book['title'] . "</td>
                                <td>" . $row['borrow_date'] . "</td>
                                <td>" . $row['due_date'] . "</td>
                                <td> ";
                        ?>      
                            <button class='table-button' data-content='<?php echo $url;?>' onclick="loadContent('<?php echo $url;?>');">Return Now</button>

                        <?php echo "</td>
                            </tr>";
                    }
                } 
                else 
                {
                    echo "<h4>No borrowed books found !</h4>";    
                }
                $conn->close();

            ?>
        </table>
    </body>
</html>
