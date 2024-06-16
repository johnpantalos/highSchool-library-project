<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../users/login.php");
        exit();
    }

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname 
    
    // Fetch all Books created
    $sql = "SELECT * FROM BorrowRecords";
    // $sql = "SELECT * FROM BorrowRecords ORDER BY id";


    $result_bor_books = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <title>Show Books</title>
    </head>
    <body>
        <h4>Here is the list of the Borrowed Books : </h4><br>
        <table border='1' style='margin-left: auto; margin-right: auto; width: 100%;'>
        <tr>
            <th>ID</th>
            <th>Student ID</th>
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
                while($row = $result_bor_books->fetch_assoc()) 
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
                            <td>" . $row['return_date'] . "</td>
                            <td> ";
                    if($row['return_date'] === '0000-00-00'){
                        ?>
                            
                        <button class='table-button' data-content='<?php echo $url;?>' onclick="loadContent('<?php echo $url;?>');">Return Now</button>

                    <?php 
                    } 
                    else 
                    {
                        echo "Already Returned";
                    }
                    echo "
                        </td>
                    </tr>";
                }
            } 
            else 
            {
                echo "<h4>No Borrowed Books Found !</h4>";
            }
            
            $conn->close();
        ?>
        </table>
        <script>
            
            document.addEventListener('DOMContentLoaded', () => {
                const buttons = document.querySelectorAll('.table-button');
                const bottomRow = document.querySelector('.bottomRow');
    
                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        removeLoadedContent();
                        const contentUrl = button.getAttribute('data-content');
                        loadContent(contentUrl);
                    });
                });
    
                // Load initial content
                loadContent(buttons[0].getAttribute('data-content'));
            });
            
        </script>
    </body>
</html>
