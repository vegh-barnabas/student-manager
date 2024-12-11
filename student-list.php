<?php
    session_start();

    require "helper-functions.php";
    require "storage.php";

    $input = $_POST;
    if(count($input) !== 0 && isset($input["logout"])) {
        logout();
    }

    if(!isset($_SESSION["user"])) {
        redirect("index.php");
    }

    $user_storage = new Storage(new JsonIO("users.json"));
    $students = $user_storage->findAll();

    $oldest_student = null;
    $oldest_timestamp = null;

    // Get oldest student
    foreach($students as $student) {
        $current_timestamp = strtotime($student["dateOfBirth"]); // number of seconds since Jan 1 1970

        if($oldest_timestamp == null || $current_timestamp < $oldest_timestamp) {
            $oldest_timestamp = $current_timestamp;
            $oldest_student = $student;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Student Manager - Students</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>

        <nav class="navbar">
            <div id="left">
                <span id="title">Student Manager</span>
                <a href="student-list.html" class="current">Students</a>
                <a href="#">Add student</a>
            </div>
            <div id="right">
            <form method="POST">
                <button type="submit" name="logout">Log out</button>
            </form>
                <span id="userInfo"><?= $_SESSION["user"]["username"] ?> | <?= $_SESSION["user"]["neptun"] ?></span>
            </div>
        </nav>
        <div class="container">
            <?php if(isset($_GET["registration"]) && $_GET["registration"]): ?>
                <h3 class="successMessage">Registration successful! You've been automatically logged in!</h3>
            <?php endif ?>

            <h1>Student List</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Neptun Code</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Classes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $student): ?>
                        <tr>
                            <td><?= $student["id"] ?></td>
                            <td><?= $student["username"] ?></td>
                            <td><?= $student["neptun"] ?></td>
                            <td><?= $student["dateOfBirth"] ?></td>
                            <td><?= ucfirst($student["gender"]) ?></td>
                            <td>
                                <ul>
                                    <?php foreach($student["classes"] as $class): ?>
                                        <li><?= $class ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="statistics">
                <p><strong>Statistics:</strong></p>
                <p>Oldest Student:  <?= $oldest_student["username"] ?> with DOB <?= $oldest_student["dateOfBirth"] ?> (<?= calculate_age_from_DOB($oldest_student["dateOfBirth"]) ?> years old)</p>
                <p>Total Students: <?= count($students) ?></p>
            </div>

            <div class="studentSearch">
                <input type="text" id="searchStudentInput">
                <button id="searchStudentButton">Search Students including "a" letter</button>
                <p id="searchStudentResult"></p>
            </div>
        </div>

        <script>
            const searchButton = document.querySelector('#searchStudentButton')
            const searchInput = document.querySelector('#searchStudentInput')
            const searchResult = document.querySelector('#searchStudentResult')

            searchButton.addEventListener('click', function() {
                const neptun = searchInput.value

                const xhr = new XMLHttpRequest()
                xhr.addEventListener('load', responseHandler)
                xhr.open('GET', `http://localhost:8000/search-handler.php?neptun=${neptun}`)
                xhr.responseType = 'json'
                xhr.send(null)
            })

            function responseHandler() {
                const student = this.response
                if(student.error) {
                    searchResult.innerText = student.error
                }
                else {
                   searchResult.innerText = `Student with neptun code ${student.neptun} is ${student.username}`
                }
                console.log(student)
            }
        </script>
    </body>
</html>