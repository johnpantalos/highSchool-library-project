<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../css/style.css">
        <style type="text/css">
            html {
                background-image: none;
            }
        </style>
        <script>
            function showPassword() {
                var x = document.getElementById("pwd");
                var y = document.getElementById("pwd1");
                if (x.type === "password" && y.type === "password") {
                    x.type = "text";
                    y.type = "text";
                } else {
                    x.type = "password";
                    y.type = "password";
                }
            }
        </script>
</head>
<body>
    <div class="container-big-2">
        <h2>Register</h2>
        <form action="register_action.php" class="register-user-form" method="POST">
            <label for="name">Name: </label>
            <input type="text" name="name" required>
            
            <label for="username">Username: </label>
            <input type="text" name="username" required>
            
            <label for="password">Password: </label>
            <input type="password" name="password" id="pwd" required>
            
            <label for="password"> Confirm Password: </label>
            <input type="password" name="confirmpassword" id="pwd1" required>
            <span><input type="checkbox" onclick="showPassword()">Show Password</span>
            
            <label for="user_type"> User Type: </label>
            <select name="user_type">
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <br>
            
            <input type="submit" value="Register">
        </form>

    </div>
</body>
</html>
