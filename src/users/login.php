<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Login</title>
        <script>
            function showPassword() {
                var x = document.getElementById("pwd");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </head>
    <body>
        <div class="container-1">        
            <h1 style="text-align: center;">Welcome !</h1>
            <p>Please sign in for your best experience.</p>
            
            <h2 style="text-align: start;">Login</h2>
            <form action="authenticate.php" class="login-form" method="POST">
                <label for="username">Username: </label>
                <input type="text" name="username" required>
                <label for="password">Password: </label>
                <input type="password" name="password" id="pwd" required>
                <span><input type="checkbox" onclick="showPassword()"> Show Password</span>
                <input type="submit" value="Login">
            </form>
            <a href="../../index.php" class="table-button" style="padding: 10px;position: fixed; bottom: 22%;">HOME</a>
        </div>
    </body>
</html>
