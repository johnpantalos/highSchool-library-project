<?php

// Database configuration and connection
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

$book_id = intval($_GET['book_id']);

$sql = "SELECT * FROM Books WHERE id='$book_id'";
$result_book = $conn->query($sql);
$book_row = $result_book->fetch_assoc();

$title = $book_row['title'];
$author = $book_row['author'];
$copies_available = $book_row['copies_available'];

// Fetch all Students
$sql_st = "SELECT * FROM Students";
$result_students = $conn->query($sql_st);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Borrow Book</title>
        <link rel="stylesheet" href="../css/style.css">
        <style type="text/css">
            html {background-image: none;}
            select,
            form input[type="text"],
            form input[type="password"],
            form input[type="email"] {
                padding: 5px;
                font-size: 1em;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 100%;
            }

        </style>
</head>
<body>
    <h2>Borrow Book For Student</h2>
    <form action="./books/admin_borrow_book_for_student_action.php" class="universal-form" method="POST">
        <label for="ID">ID: </label>
        <input type="text" name="id" value="<?php echo $book_id;?>" readonly><br>
        
        <label for="title">Title: </label>
        <input type="text" name="title" value="<?php echo $title;?>" readonly><br>
        
        <label for="author">Author: </label>
        <input type="text" name="author" value="<?php echo $author;?>" readonly><br>
        
        <label for="copies_available"> Copies available: </label>
        <input type="text" name="copies_available" value="<?php echo $copies_available; ?>" readonly><br><br>
        
        <label for="student"> Please select the student who wants to borrow this book: </label>
        <?php 
            if ($result_students->num_rows > 0) 
            {
                echo '<select name="student">';
                while($row = $result_students->fetch_assoc()) 
                {
                    echo '<option value="' . $row['id'] . '" id="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';   
                }
                echo "</select>";
            }
            else
            {
                echo "No students found";
            }
        ?>
        <br>
        
        <label for="date">Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); $conn->close();?>" id="date" name="date">
        <br>
        <input type="submit" value="Borrow">
    </form>
</body>
</html>
