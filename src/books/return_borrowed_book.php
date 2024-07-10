<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: ../users/login.php");
        exit();
    }

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

    // Get user BorrowRecord-ID from URL
    $Borrowed_id = $_GET['id'];

    // Fetch borrowed book details
    $sql = "SELECT * FROM borrowrecords WHERE id='$Borrowed_id'";
    $result_bor_book = $conn->query($sql);
    $borr_book = null;
    if($result_bor_book->num_rows > 0) $borr_book = $result_bor_book->fetch_assoc();


    // Convert to DateTime objects
    $date_borrowed = new DateTime($borr_book['borrow_date']);

    // Get current date 
    $current_date = new DateTime('now');
    $currentDate = $current_date->format('Y-m-d'); 

    // Calculate the difference
    $interval = $date_borrowed->diff($current_date);

    if ($interval->days < 30) {

        $book_id = $borr_book['book_id'];
        
        // Fetch borrowed book details
        $sql_b = "SELECT * FROM books WHERE id='$book_id'";
        $result_book = $conn->query($sql_b);
        
        if($result_book->num_rows > 0) $book = $result_book->fetch_assoc();
        $updated_copies = intval($book['copies_available']) + 1;
        $sql_bb = "UPDATE books SET copies_available='$updated_copies' WHERE id='$book_id'";

        if ($conn->query($sql_bb) === TRUE) 
        {
            $student_id = $borr_book['student_id'];

            // Fetch borrowed book details
            $sql_student = "SELECT * FROM students WHERE id='$student_id'";
            $result_student = $conn->query($sql_student);

            if($result_student->num_rows > 0) $student = $result_student->fetch_assoc();
            $updated_count_bor = intval($student['borrowed_books_count']) - 1;
            
            $sql_bbr = "UPDATE students SET borrowed_books_count='$updated_count_bor' WHERE id='$student_id'";
            
            if ($conn->query($sql_bbr) === TRUE) 
            {
                // Update details
                $sql = "UPDATE borrowrecords SET return_date='$currentDate' WHERE id='$Borrowed_id'";
                
                if ($conn->query($sql) === TRUE) 
                {
                    // Redirect using JavaScript to go back 1 page
                    echo "<h4 style='text-align: center; color: black;'>Book successfully returned !</h4>";
                    exit();
                }
                else
                {
                    echo "Error updating record: " . $conn->error;
                }
            }
            else
            {
                echo "Error updating record: " . $conn->error;
            }
        }
        else
        {
            echo "Error updating record: " . $conn->error;
        }

    }
    else
    {
        echo "<h4'>More than a month has passed since the book was borrowed. Book can't be returned</h4>";
    }

    $conn->close();

    exit();
?>
