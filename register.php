<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Student Manager - Login</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <?php require 'helper-functions.php' ?>

        <?php
            // - Validation rules -
            // Username should be: minimum 3 characters, maximum 8 characters
            // Password should be: minimum 3 characters, no maximum, should contain a number and a letter
            // Neptun code should be: 6 characters long, uppercase letters or numbers
            // Gender should be: Either Male or Female
            // Classes should be: Empty, or any elements from the checkbox options

            // & means that the argument is being passed by reference rather than by value
            // so the function can directly modify the original variable's value
            function validate($input, &$data, &$errors) {
                // Validate username
                $data["username"] = null;
                if (is_empty($input, "username")) {
                    $errors["username"] = "Username is mandatory!";
                } 
                else if (strlen($input["username"]) < 3 || strlen($input["username"]) > 8) {
                    $errors["username"] = "Username should be more than 3 characters, and less than 8 characters long!";
                }
                else {
                    $data["username"] = trim($input["username"]);
                }

                // Validate password
                $skip_password_again_validation = true;
                $data["password"] = null;
                if (is_empty($input, "password")) {
                    $errors["password"] = "Password is mandatory!";
                }
                else if (strlen($input["password"]) < 3) {
                    $errors["password"] = "Password should be more than 3 characters long!";
                }
                else if (!contains_letter_and_number($input["password"])) {
                    $errors["password"] = "Password should contain at least one letter and one number!";
                }
                else {
                    $data["password"] = trim($input["password"]);
                    $skip_password_again_validation = false;
                }

                // Validate password again
                if (!$skip_password_again_validation) {
                    $data["passwordAgain"] = null;
                    if ($input["passwordAgain"] != $data["password"]) {
                        $errors["passwordAgain"] = "Passwords do not match!";
                    }
                    else {
                        $data["passwordAgain"] = trim($input["passwordAgain"]);
                    }
                }

                // Validate neptun code
                $data["neptun"] = null;
                if (is_empty($input, "neptun")) {
                    $errors["neptun"] = "Neptun is mandatory!";
                }
                else if (strlen($input["neptun"]) != 6) {
                    $errors["neptun"] = "Neptun code should be 6 characters long!";
                }
                else if (strtoupper($input["neptun"]) != $input["neptun"]) {
                    $errors["neptun"] = "Neptun code should be all uppercase letters and numbers!";
                }
                else {
                    $data["neptun"] = trim($input["neptun"]);
                }

                // Validate gender
                $data["gender"] = null;
                if (is_empty($input, "gender") || !in_array($input["gender"], ["male", "female"])) {
                    $errors["gender"] = "Gender must be selected as Male or Female!";
                } else {
                    $data["gender"] = $input["gender"];
                }

                // Validate classes (checkboxes)
                $data["classes"] = [];
                $validClasses = ["webprog", "discrete", "linux"];
                foreach ($validClasses as $class) {
                    if (isset($input[$class])) {
                        $data["classes"][] = $class;
                    }
                }

                return !(bool)$errors;
            }

            // Start
            $successful = false;
            $errors = [];
            $data = [];
            $input = $_GET;

            var_dump($input);

            // Check
            if (validate($input, $data, $errors)) {
                $successful = true;

                // Save to the database later
            }
        ?>

        <nav class="navbar">
            <span>Student Manager</span>
        </nav>

        <div class="container">
            <h1>Student Manager - Register</h1>

            <?php if ($successful): ?>
                <h3 class="successMessage">Registration successful! Now you can log in!</h3>
            <?php endif ?>

            <form id="registerForm" method="GET">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Enter a username"
                    value="<?= $data['username'] ?? '' ?>"
                    required
                />
                <?php if (isset($errors['username'])): ?>
                    <div class="error"><?= $errors['username'] ?></div>
                <?php endif ?>

                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter a password"
                    value="<?= $data['password'] ?? '' ?>"
                    required
                />
                <?php if (isset($errors['password'])): ?>
                    <div class="error"><?= $errors['password'] ?></div>
                <?php endif ?>

                <label for="passwordAgain">Password again</label>
                <input
                    type="password"
                    id="passwordAgain"
                    name="passwordAgain"
                    placeholder="Enter the password again"
                    value="<?= $data['passwordAgain'] ?? '' ?>"
                    required
                />
                <?php if (isset($errors['passwordAgain'])): ?>
                    <div class="error"><?= $errors['passwordAgain'] ?></div>
                <?php endif ?>

                <label for="neptun">Neptun Code</label>
                <input
                    type="text"
                    id="neptun"
                    name="neptun"
                    placeholder="Enter a neptun code"
                    value="<?= $data['neptun'] ?? '' ?>"
                    required
                />
                <?php if (isset($errors['neptun'])): ?>
                    <div class="error"><?= $errors['neptun'] ?></div>
                <?php endif ?>

                <fieldset>
                    <legend>Gender</legend>
                    <div>
                        <input
                            type="radio"
                            id="male"
                            name="gender"
                            value="male"
                            <?= isset($data['gender']) && $data['gender'] === 'male' ? 'checked' : '' ?>
                        />
                        <label for="male">Male</label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            id="female"
                            name="gender"
                            value="female"
                            <?= isset($data['gender']) && $data['gender'] === 'female' ? 'checked' : '' ?>
                        />
                        <label for="female">Female</label>
                    </div>
                </fieldset>
                    <?php if (isset($errors['gender'])): ?>
                        <div class="error"><?= $errors['gender'] ?></div>
                    <?php endif ?>

                <fieldset>
                    <legend>Your classes</legend>
                    <div>
                        <input 
                            type="checkbox" 
                            id="webprog" 
                            name="webprog"
                            <?= in_array('webprog', $data['classes'] ?? []) ? 'checked' : '' ?>
                        />
                        <label for="webprog">Webprogramming</label>
                    </div>
                    <div>
                        <input 
                            type="checkbox" 
                            id="discrete" 
                            name="discrete"
                            <?= in_array('discrete', $data['classes'] ?? []) ? 'checked' : '' ?>
                        />
                        <label for="discrete">Discrete Mathematics</label>
                    </div>
                    <div>
                        <input 
                            type="checkbox" 
                            id="linux" 
                            name="linux"
                            <?= in_array('linux', $data['classes'] ?? []) ? 'checked' : '' ?>
                        />
                        <label for="linux">Linux Basics</label>
                    </div>
                </fieldset>
                <button type="submit">Register</button>
            </form>
            <a href="index.php">Click here to log in!</a>
        </div>
    </body>
</html>
