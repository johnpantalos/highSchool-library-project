<?php
session_start();

// Database configuration and connection
include "./database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

$id = intval($_GET['id']);

// Fetch user details
$sql = "SELECT * FROM Admins WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <title>Admin Dashboard</title>
        <style>
            open-btn {
                margin-top: 0%;
                margin-bottom: 0%;
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
                    <h2 style="margin-bottom: 40px;">Admin Dashboard</h2>
                </div>
                <ul class="sidebar-menu">
                    <!-- <li><a href="student_dashboard.php" class="sidebar-link" data-target="content1">Dashboard</a></li> -->
                    <li><a href="browse_catalog.php" class="sidebar-link active" data-target="navbar-books"><i style="font-size:24px" class="fa">&#xf02d;</i> &nbsp; Books</a></li>
                    <li><a href="my_borrowed_books.php" class="sidebar-link" data-target="navbar-students"> <i class="fa fa-user-circle" aria-hidden="true"></i> &nbsp; Users</a></li>
                    <li><a href="./users/logout.php" style="width:250px; position:fixed; bottom:50px;"><i style="font-size:24px" class="fa">&#xf08b;</i> &nbsp; Logout</a></li>
                </ul>
            </div>
            <div class="main">
                
                <div class="top-row">
                    <h1>Welcome <?php echo $user['name'];?></h1><br>
                    <p><b>You are connected to your school’s library portal.</b></p>
                </div>

                <div id="navbar-books">
                    <button class="nav-button active" data-content="./books/modify_books.php?id=<?php echo $id; ?>">Book Management</button>
                    <button class="nav-button" data-content="./books/register_book.php?id=<?php echo $id?>">Add a new book</button>
                    <button class="nav-button" data-content="./books/show_all_borrowed_books.php?id=<?php echo $id?>">Borrowed Books</button>
                </div>
                
                <div id="navbar-students" style="display: none;">
                    <button class="nav-button active" data-content="./users/show_all_students.php?id=<?php echo $id?>">Manage students</button>
                    <button class="nav-button" data-content="./users/register.php?id=<?php echo $id?>">Add a new user</button>
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
                            loadContent(buttons[3].getAttribute('data-content'));
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

    </body>
</html>
