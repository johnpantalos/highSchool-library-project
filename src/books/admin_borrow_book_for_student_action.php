<?php

include '../database/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Get POST data
    $book_id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $copies_available = $_POST['copies_available'];
    $student_id = $_POST['student'];
    $date_borrowed = $_POST['date'];
}
// Date
// Create a DateTime object from the submitted date
$dateObj = new DateTime($date_borrowed);
// Add one month to the date
$dateObj->modify('+1 month');
// Format the new date to a string
$newDate = $dateObj->format('Y-m-d');

// Fetch Book 
$sql_b = "SELECT * FROM Books WHERE id='$book_id'";
$result_books = $conn->query($sql_b);
if($result_books->num_rows > 0) $book_want_to_borrow = $result_books->fetch_assoc();


// Fetch Student  
$sql_st = "SELECT * FROM Students WHERE id='$student_id'";
$result_student = $conn->query($sql_st);
if($result_student->num_rows > 0) $student = $result_student->fetch_assoc();

$copies_of_book = intval($book_want_to_borrow['copies_available']);
$borrowed_books_count = intval($student['borrowed_books_count']);

if($copies_of_book > 0){
    if($borrowed_books_count < 3){
        // Insert user into the database
        $sql_borr = "INSERT INTO BorrowRecords (student_id, book_id, borrow_date, due_date, return_date) 
        VALUES ('$student_id', '$book_id' , '$date_borrowed', '$newDate', 'null')";

        if ($conn->query($sql_borr) === TRUE) 
        {
            // Update Book Copies Available Variable (-1)
            $copies_of_book = intval($copies_of_book) - 1;
            $sql_update_copies_available = "UPDATE Books SET copies_available='$copies_of_book' WHERE id='$book_id'";

            if ($conn->query($sql_update_copies_available) === TRUE) 
            {
                $borrowed_books_count = $borrowed_books_count + 1;
                $sql_update_borrowed_books_in_student = "UPDATE Students SET borrowed_books_count='$borrowed_books_count' WHERE id='$student_id'";
                
                if ($conn->query($sql_update_borrowed_books_in_student) === TRUE) 
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
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        
    }
    else
    {
        echo "You can't borrow this book! Student had reached the limit of borrowed books";
    }
}
else
{
    echo "You can't borrow this book! Copies Available: 0";
}

?>