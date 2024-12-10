<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Student Manager - Login</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <?php
            require "helper-functions.php";
            require "storage.php";

            // - Validation rules -
            // Username should be: minimum 3 characters, maximum 8 characters
            // Password should be: minimum 3 characters, no maximum, should contain number and letter too
            // Gender should be: Either Male or Female
            // Classes should be: Empty, or any elements from the checkbox options

            // & means that the argument is being passed by reference rather than by value
            // so the function can directly modify the original variable's value
            function validate($input, &$data, &$errors) {
                global $user_storage;

                // Username
                $data["username"] = null;
                if(is_empty($input, "username")) {
                    $errors["username"] = "Username is mandatory!";
                }
                else if(strlen($input["username"]) < 3 || strlen($input["username"]) > 8) {
                    $errors["username"] = "Username should be more than 3 characters, and less than 8 characters long!";
                }
                else if($user_storage->findOne(['username' => $input["username"]]) != NULL) {
                    $errors["username"] = "This username is taken!";
                }
                else {
                    $data["username"] = $input["username"];
                }

                // Password
                $data["password"] = null;
                if(is_empty($input, "password")) {
                    $errors["password"] = "Password is mandatory!";
                }
                else if(strlen($input["password"]) < 3) {
                    $errors["password"] = "Password should be more than 3 characters long!";
                }
                else if(!contains_letter_and_number($input["password"])) {
                    $errors["password"] = "Password should contain at least one letter and one number!";
                }
                else if(trim($input["password"]) != trim($input["passwordConfirm"])) {
                    $errors["password"] = "Passwords don't match!";
                    $errors["passwordConfirm"] = "Passwords don't match!";
                }
                else {
                    $data["password"] = $input["password"];
                }

                // Gender
                $data["gender"] = null;
                if(is_empty($input, "gender")) {
                    $errors["gender"] = "Gender is mandatory!";
                }
                // $input["gender"] !== "male" || $input["gender"] !== "female"
                else if(!in_array($input["gender"], ["male", "female"])) {
                    $errors["genders"] = "Gender must be selected as Male or Female!";
                }
                else {
                    $data["gender"] = $input["gender"];
                }

                // Validate classes
                $data["classes"] = null;
                $valid_classes = ["webprog", "discrete", "linux"];
                foreach ($valid_classes as $class) {
                    // for example if you ticked $input["linux"]
                    if(isset($input[$class])) {
                        $data["classes"][] = $class; // push into array of classes
                    }
                }

                // 2 states:
                // if it's [], it will be false
                // if it's ["..."], it will be true
                return !(bool)$errors;
            }

            // Start
            $user_storage = new Storage(new JsonIO("users.json"));
            $success = false;
            $errors = [];
            $data = [];
            $input = $_GET;

            var_dump($data);

            if(count($input) !== 0) {
                if(validate($input, $data, $errors)) {
                    // Validation successful
                    $success = true;

                    $neptun = generate_random_neptun();
                    $user_with_neptun = $user_storage->findOne(["neptun" => $neptun]);
                    var_dump($user_with_neptun);
                    while(isset($user_with_neptun)) {
                        $neptun = generate_random_neptun();
                    }

                    $user_id = $user_storage->add([
                        "username" => $data["username"],
                        "password" => password_hash($data['password'], PASSWORD_DEFAULT),
                        "neptun" => $neptun,
                        "gender" => $data["gender"],
                        "classes" => $data["classes"]
                    ]);

                    $user = $user_storage->findById($user_id);

                    $_SESSION["user"] = $user;
                    redirect("student-list.php");
                    var_dump($_SESSION["user"]);
                }
            }
        ?>

        <nav class="navbar">
            <span>Student Manager</span>
        </nav>
        <div class="container">
            <h1>Student Manager - Register</h1>

            <?php if($success): ?>
                <h3 class="successMessage">Registration successful! Now you can log in!</h3>
            <?php endif ?>

            <form id="registerForm" type="GET">
                <label for="username">Username</label>
                <!-- isset($data["username"]) ? $data["username"] : "" -->
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Enter a username"
                    value="<?= $data["username"] ?? "" ?>"
                />
                <?php if(isset($errors["username"])) : ?>
                    <div class="error"><?= $errors["username"] ?></div>
                <?php endif ?>

                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter a password"
                    value="<?= $data["password"] ?? "" ?>"
                />
                <?php if(isset($errors["password"])) : ?>
                    <div class="error"><?= $errors["password"] ?></div>
                <?php endif ?>

                <label for="passwordConfirm">Password again</label>
                <input
                    type="password"
                    id="passwordConfirm"
                    name="passwordConfirm"
                    placeholder="Enter the password again"
                    value="<?= $data["password"] ?? "" ?>"
                />
                <?php if(isset($errors["passwordConfirm"])) : ?>
                    <div class="error"><?= $errors["passwordConfirm"] ?></div>
                <?php endif ?>

                <fieldset>
                    <legend>Gender</legend>
                    <div>
                        <input
                            type="radio"
                            id="male"
                            name="gender"
                            value="male"
                            <?= isset($data["gender"]) && $data["gender"] == "male" ? "checked" : "" ?>
                        />
                        <label for="male">Male</label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            id="female"
                            name="gender"
                            value="female"
                            <?= isset($data["gender"]) && $data["gender"] == "female" ? "checked" : "" ?>
                        />
                        <label for="female">Female</label>
                    </div>
                </fieldset>
                <?php if(isset($errors["gender"])) : ?>
                    <div class="error"><?= $errors["gender"] ?></div>
                <?php endif ?>

                <fieldset>
                    <legend>Your classes</legend>
                    <div>
                        <input 
                            type="checkbox" 
                            id="webprog" 
                            name="webprog"
                            <? if(isset($data["classes"]) && in_array("webprog", ($data["classes"]))): ?>
                                <?= "checked" ?>
                            <? endif ?>
                        />
                        <label for="webprog">Webprogramming</label>
                    </div>
                    <div>
                        <input 
                            type="checkbox" 
                            id="discrete" 
                            name="discrete"
                            <? if(isset($data["classes"]) && in_array("discrete", ($data["classes"]))): ?>
                                <?= "checked" ?>
                            <? endif ?>
                        />
                        <label for="discrete">Discrete Mathematics</label>
                    </div>
                    <div>
                        <input 
                            type="checkbox" 
                            id="linux" 
                            name="linux"
                            <? if(isset($data["classes"]) && in_array("linux", ($data["classes"]))): ?>
                                <?= "checked" ?>
                            <? endif ?>
                        />
                        <label for="linux">Linux Basics</label>
                    </div>
                </fieldset>
                <?php if(isset($errors["classes"])) : ?>
                    <div class="error"><?= $errors["classes"] ?></div>
                <?php endif ?>

                <button type="submit">Register</button>
            </form>
            <a id="registerLink" href="index.php">Click here to log in!</a>
        </div>
    </body>
</html>    