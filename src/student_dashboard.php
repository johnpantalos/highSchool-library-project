<?php
session_start();

// Database configuration and connection
include "./database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

$id = intval($_GET['id']);

// Fetch all Books created
$sql = "SELECT * FROM Books";
$result_books = $conn->query($sql);

// Fetch Books borrowed by this user (id)
$sql_s = "SELECT * FROM Students WHERE id='$id'"; 
$result_student = $conn->query($sql_s);
if($result_student->num_rows > 0) $student = $result_student->fetch_assoc();

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./css/style.css">
        <style type="text/css">
            .container {
                background-color: #007bff00;
            }
        </style>
        <title>Student Dashboard</title>
    </head>
    <body>
        <header>
            <a href="../index.php">Home</a>
            <span class="text-center"> &nbsp; Student's Dashboard </span>
            <div class="header-right">
                <a href="./users/logout.php">Logout</a>
            </div>
        </header>
        <div class="container-big">
            <h2>Welcome <?php echo $student['name'];    ?></h2>
            <p>Here is some actions you have permissions for !</p>

            <div class="container">
                <div class="container-column-1">
                    <p>BOOKS</p>

                    <!-- IFRAME 1 -->
                    <button class="open-btn" onclick="openPopup('popup1')">Available Books</button>
                    
                    <div class="popup-container" id="popup1">
                        <div class="iframe-container">
                            <button class="close-btn" onclick="closePopup('popup1')">×</button>
                            <iframe src="./books/show_available_books.php"></iframe>
                        </div>
                    </div>
                    
                    <!-- IFRAME 2 -->
                    <button class="open-btn" onclick="openPopup('popup2')">Borrowed Books</button>

                    <div class="popup-container" id="popup2">
                        <div class="iframe-container">
                            <button class="close-btn" onclick="closePopup('popup2')">×</button>
                            <iframe src="./books/show_borrowed_books_for_each_student.php?id=<?php echo $id?>"></iframe>
                        </div>
                    </div>
                </div>

                <div class="container-column-2">
                    <p>EDIT USER</p>
                        <!-- IFRAME 3 -->
                    <button class="open-btn" onclick="openPopup('popup3')">Edit User</button>
                    
                    <div class="popup-container" id="popup3">
                        <div class="iframe-container">
                            <button class="close-btn" onclick="closePopup('popup3')">×</button>
                            <iframe src="./users/edit_user_by_student.php?id=<?php echo $id?>" class="iframe-small"></iframe>
                        </div>
                    </div>
                </div>
                
                <script>
                    function openPopup(id) {
                        document.getElementById(id).classList.add('show');
                        document.addEventListener('keydown', handleEscKey);
                    }

                    function closePopup(id) {
                        document.getElementById(id).classList.remove('show');
                        document.removeEventListener('keydown', handleEscKey);
                        location.reload(); // Reload the page when the popup is closed
                    }

                    function handleEscKey(event) {
                        if (event.key === 'Escape') {
                            const popups = document.querySelectorAll('.popup-container.show');
                            popups.forEach(popup => popup.classList.remove('show'));
                            document.removeEventListener('keydown', handleEscKey);
                            location.reload(); // Reload the page when the popup is closed
                        }
                    }
                </script>
            </div>
        </div>

        <footer>
            <p>
                Copyright &copy Johnpantalos;
            </p>
        </footer>
    </body>
</html>
