<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../users/login.php");
        exit();
    }

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

    // Get book ID from URL
    $book_id = intval($_GET['book_id']);

    function deleteBook($book_id) {
        global $conn;

        // Fetch norrowed book from database
        $sql = "SELECT * FROM borrowrecords WHERE book_id = '$book_id'";
        $result_bor_books = $conn->query($sql);
        if ($result_bor_books->num_rows > 0) 
        {
            while($row = $result_bor_books->fetch_assoc()){
                
                $student_id = $row['student_id'];
                
                // Fetch norrowed book from database
                $sql_s = "SELECT * FROM students WHERE id = '$student_id'";
                $result_student = $conn->query($sql_s);
                
                if ($result_student->num_rows > 0) 
                {
                    $row_s = $result_student->fetch_assoc();
                    $borrowed_books_count = intval($row_s['borrowed_books_count']);
                    if($row['return_date'] == '0000-00-00'){
                        $borrowed_books_count--;
                    }
                    
                    $sql_update_count_br_books = "UPDATE students SET borrowed_books_count='$borrowed_books_count' WHERE id='$student_id'";
                    if ($conn->query($sql_update_count_br_books) === TRUE) 
                    {    
                        // Prepare and execute the statement to delete related borrow records first
                        $sql_delete_borrow_records = "DELETE FROM borrowrecords WHERE book_id = ?";
                        $stmt = $conn->prepare($sql_delete_borrow_records);
                        if ($stmt) {
                            $stmt->bind_param("i", $book_id);
                            $stmt->execute();
                            $stmt->close();
                        } else {
                            echo "Error preparing statement: " . $conn->error . "<br>";
                        }
                    }
                    else 
                    {
                        echo "Error: " . $sql_update_count_br_books . "<br>" . $conn->error;
                    }
                }
                else 
                {
                    echo "Error: <br>" . $conn->error;
                }
            }
                    
        }
        // Prepare and execute the statement to delete the book
        $sql_delete_book = "DELETE FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql_delete_book);
        if ($stmt) {
            $stmt->bind_param("i", $book_id);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error . "<br>";
        }

        // echo "Book and related borrow records deleted successfully<br>";
        echo '<script>alert("Book and related borrow records deleted successfully !");</script>';
        echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';

    }

    deleteBook($book_id);

    $conn->close();
?>
