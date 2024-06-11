<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <p>Please fill the form.</p>

        <h2>Register</h2>
        <form action="register_action.php" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username" required><br>
            
            <label for="password">Password: </label>
            <input type="password" name="password" required><br>
            
            <label for="password"> Confirm Password: </label>
            <input type="password" name="confirmpassword" required><br>
            <br>
            
            <label for="user_type"> User Type: </label>
            <select name="user_type">
                <option value="admin">Admin</option>
                <option value="student">Student</option>
            </select>
            <br>
            
            <input type="submit" value="Register">
        </form>

    </div>
</body>
</html>
