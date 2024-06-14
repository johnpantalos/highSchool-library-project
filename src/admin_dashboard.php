<?php
session_start();

// Database configuration and connection
include "./database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Check if the page has been reloaded
if (!isset($_SESSION['reloaded'])) 
{
    $_SESSION['reloaded'] = true;
    // Embed JavaScript to reload the page on load (helps showing the changes when edit users)
    echo '<script type="text/javascript">
        window.onload = function() {
            location.reload();
        };
    </script>';
} 
else 
{
    // Unset the session variable to avoid infinite loop
    unset($_SESSION['reloaded']);
}

$id = intval($_GET['id']);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./css/style.css">
        <title>Admin Dashboard</title>
        <style>
            open-btn {
                margin-top: 0%;
                margin-bottom: 0%;
            }
        </style>
    </head>
    <body>
        <header>
            <span> Admin's Dashboard </span>
            <div class="header-right">
                <a href="./users/logout.php">Logout</a>
            </div>
        </header>
        <div class="container-fluid">
            <div class="container-big rounded">
                
                <h2 style="text-align: center;">Manage Users</h2>

                <!-- IFRAME 1 -->
                <button class="open-btn" onclick="openPopup('popup1')">Book Management</button>
                    
                <div class="popup-container" id="popup1">
                    <div class="iframe-container">
                        <button class="close-btn" onclick="closePopup('popup1')">×</button>
                        <iframe src="./books/modify_books.php?id=<?php echo $id; ?>" class="iframe-big"></iframe>
                    </div>
                </div>
                
                <!-- IFRAME 2 -->
                <button class="open-btn" onclick="openPopup('popup2')">Register A Book</button>

                <div class="popup-container" id="popup2">
                    <div class="iframe-container">
                        <button class="close-btn" onclick="closePopup('popup2')">×</button>
                        <iframe src="./books/register_book.php?id=<?php echo $id?>" class="iframe-small"></iframe>
                    </div>
                </div>

                <!-- IFRAME 3 -->
                <button class="open-btn" onclick="openPopup('popup3')">Show All Borrowed Books</button>

                <div class="popup-container" id="popup3">
                    <div class="iframe-container">
                        <button class="close-btn" onclick="closePopup('popup3')">×</button>
                        <iframe src="./books/show_all_borrowed_books.php?id=<?php echo $id?>" class="iframe-big"></iframe>
                    </div>
                </div>

                <!-- IFRAME 4 -->
                <button class="open-btn" onclick="openPopup('popup4')">Add A New Student</button>

                <div class="popup-container" id="popup4">
                    <div class="iframe-container">
                        <button class="close-btn" onclick="closePopup('popup4')">×</button>
                        <iframe src="./users/register.php?id=<?php echo $id?>" class="iframe-big"></iframe>
                    </div>
                </div>

                <!-- IFRAME 5 -->
                <button class="open-btn" onclick="openPopup('popup5')">Show All Students</button>

                <div class="popup-container" id="popup5">
                    <div class="iframe-container">
                        <button class="close-btn" onclick="closePopup('popup5')">×</button>
                        <iframe src="./users/show_all_students.php?id=<?php echo $id?>"></iframe>
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
                <!-- IFRAME -->

                <!-- <a href="logout.php">Logout</a> -->
                <!-- <?php echo "<a href='./users/register.php?id=" . $id . "'>Add New User</a>"; ?>
                <?php echo "<a href='./books/register_book.php?id=" . $id . "'>Books Register</a>"; ?>
                <?php echo "<a href='./books/modify_books.php?id=" . $id . "'>Books Management</a>"; ?>
                <?php echo "<a href='./books/show_all_borrowed_books.php?id=" . $id . "'>Show All Borrowed Books</a>"; ?> -->
                
            </div>
        </div>

        <footer>
            <p>
                Copyright &copy Johnpantalos;
            </p>
        </footer>
    </body>
</html>
