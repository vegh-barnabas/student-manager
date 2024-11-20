<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Student Manager - Login</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <nav class="navbar">
            <span>Student Manager</span>
        </nav>
        
        <div class="container">
        <h1>Student Manager - Login</h1>
            <form id="loginForm">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    required
                />
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                />
                <button type="submit">Login</button>
            </form>
            <a id="registerLink" href="register.php">Click here to register!</a>
        </div>
    </body>
</html>
