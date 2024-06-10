<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
    
    <div class="container">        
        <h1>Welcome !</h1>
        <p>Please sign in for your best experience.</p>
        
        <h2>Login</h2>
        <form action="authenticate.php" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username" required><br>
            <label for="password">Password: </label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>

</body>
</html>
