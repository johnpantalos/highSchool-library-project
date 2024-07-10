<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    // Database configuration and connection
    include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

    // Get user ID from URL
    $id = intval($_GET['id']);

    function deleteStudent($student_id) {
        global $conn;
        // Fetch student
        $sql = "SELECT * FROM students WHERE id = '$student_id'";
        $result_books = $conn->query($sql);
        if ($result_books->num_rows > 0) 
        { 
            $row = $result_books->fetch_assoc();
            if($row['borrowed_books_count'] > 0){
                echo '<script>alert("You can\'t delete this student because he has borrowed books !");</script>';
            }   
            else
            {
                // Prepare and execute the statement to delete related borrow records first
                $sql_delete_borrow_records = "DELETE FROM borrowrecords WHERE student_id = ?";
                $stmt = $conn->prepare($sql_delete_borrow_records);
                if ($stmt) {
                    $stmt->bind_param("i", $student_id);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error . "<br>";
                }
            
                // Prepare and execute the statement to delete the student
                $sql_delete_student = "DELETE FROM students WHERE id = ?";
                $stmt = $conn->prepare($sql_delete_student);
                if ($stmt) {
                    $stmt->bind_param("i", $student_id);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error . "<br>";
                }
                // echo "Student and related borrow records deleted successfully<br>";
                echo '<script>alert("Student and related borrow records deleted successfully !");</script>';
            }
            echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
        }
    }

    deleteStudent($id);

    $conn->close();
?>
