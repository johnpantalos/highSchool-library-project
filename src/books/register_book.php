<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../css/style.css">
        <style type="text/css">
            html { background-image: none;}
        </style>

</head>
<body>
    <div class="container-big rounded">     
        <h2>Register Book</h2>
        <form action="register_book_action.php" class="register-book-form" method="POST">
            <label for="title">Title: </label>
            <input type="text" name="title" required><br>
            
            <label for="author">Author: </label>
            <input type="text" name="author" required><br>
            
            <label for="copies_available"> Copies available: </label>
            <input type="text" name="copies_available" required><br>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
