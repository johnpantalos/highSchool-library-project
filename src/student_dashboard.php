<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ./users/login.php");
    exit();
}

// Database configuration and connection
include "./database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

$id = $_SESSION['id'];

// Fetch all Books created
$sql = "SELECT * FROM books";
$result_books = $conn->query($sql);

// Fetch Books borrowed by this user (id)
$sql_s = "SELECT * FROM students WHERE id='$id'"; 
$result_student = $conn->query($sql_s);
if($result_student->num_rows > 0) $student = $result_student->fetch_assoc();

?>

<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <style type="text/css">
            .container {
                background-color: #007bff00;
            }
        </style>
        <script type="text/javascript">
            // Variable to store the loaded content
            let loadedContent = null;

            function loadContent(url) {
                removeLoadedContent();
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        // Store the loaded data
                        loadedContent = data;
                        // Display the loaded content
                        bottomRow.innerHTML = data;
                    })
                    .catch(error => console.error('Error loading content:', error));
            }
            function removeLoadedContent() {
                if (loadedContent) {
                    bottomRow.innerHTML = ''; // Clear the content from bottomRow
                    loadedContent = null; // Reset loadedContent variable
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <div class="sidebar-header">
                    <h2 style="margin-bottom: 40px; color: white;">Student Dashboard</h2>
                </div>
                <ul class="sidebar-menu">
                    <!-- <li><a href="student_dashboard.php" class="sidebar-link" data-target="content1">Dashboard</a></li> -->
                    <li><a href="browse_catalog.php" class="sidebar-link active" data-target="navbar-books"> <i style="font-size:24px" class="fa">&#xf02d;</i> Books</a></li>
                    <li><a href="my_borrowed_books.php" class="sidebar-link" data-target="navbar-students">Account Settings</a></li>

                    <li><a href="./users/logout.php" style="width:250px; position:fixed; bottom:50px;"><i style="font-size:24px" class="fa">&#xf08b;</i> Logout</a></li>
                </ul>
            </div>
            <div class="main">
                
                <div class="top-row">
                    <h1>Welcome <?php echo $student['name'];?></h1><br>
                    <p style="color: white;"><b>You are connected to your school’s library portal.</b></p>
                </div>

                <div id="navbar-books">
                    <button class="nav-button active" data-content="./books/show_available_books.php">Available Books</button>
                    <button class="nav-button" data-content="./books/show_borrowed_books_for_each_student.php?id=<?php echo $id?>">Borrowed Books</button>
                </div>
                
                <div id="navbar-students" style="display: none;">
                    <button class="nav-button active" data-content="./users/edit_user_by_student.php?id=<?php echo $id?>">Edit account</button>
                </div>
                
                <div id="bottomRow">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>

        <script>
            // For changing navbar buttons
            document.addEventListener('DOMContentLoaded', () => {
                const navLinks = document.querySelectorAll('.sidebar-link');

                navLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        navLinks.forEach(btn => btn.classList.remove('active'));
                        link.classList.add('active');
                        e.preventDefault();
                        const targetId = link.getAttribute('data-target');
                        const targetElement = document.getElementById(targetId);

                        if (targetElement.id === 'navbar-books') 
                        {
                            targetElement.style.display = 'flex';
                            document.getElementById('navbar-students').style.display = 'none';
                            const buttons = document.querySelectorAll('.nav-button');
                            loadContent(buttons[0].getAttribute('data-content'));
                        } 
                        else if (targetElement.id === 'navbar-students')
                        {
                            targetElement.style.display = 'flex';
                            document.getElementById('navbar-books').style.display = 'none';
                            const buttons = document.querySelectorAll('.nav-button');
                            loadContent(buttons[2].getAttribute('data-content'));
                        }
                    });
                });
            }); 

            // For changing bottomRow content
            document.addEventListener('DOMContentLoaded', () => {
                const buttons = document.querySelectorAll('.nav-button');

                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        buttons.forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');
                        const contentUrl = button.getAttribute('data-content');
                        loadContent(contentUrl);
                    });
                });
                // Load initial content
                loadContent(buttons[0].getAttribute('data-content'));
            });
        </script>
        <?php 
            $conn->close();
        ?>
    </body>
</html>
