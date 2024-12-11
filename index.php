<?php
    session_start();

    require "helper-functions.php";
    require "storage.php";
    
    // Start
    $user_storage = new Storage(new JsonIO("users.json"));
    $success = false;
    $errors = [];
    $data = [];
    $input = $_POST;

    if(isset($_SESSION["user"])) {
        redirect("student-list.php");
    }

    if(count($input) !== 0) {
        $user = $user_storage->findOne(["username" => $input["username"]]);

        if($user == null) {
            $errors["login"] = "This username/password combination doesn't exist.";
        }

        else if(password_verify($input["password"], $user["password"])) {
            // Login successful
            $_SESSION["user"] = $user;
            redirect("student-list.php");
        }
    }
?>

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
            <form id="loginForm" method="POST">
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
                
                <?php if(isset($errors["login"])) : ?>
                    <div class="error"><?= $errors["login"] ?></div>
                <?php endif ?>

                <button type="submit">Login</button>
            </form>
            <a id="registerLink" href="register.php">Click here to register!</a>
        </div>
    </body>
</html>