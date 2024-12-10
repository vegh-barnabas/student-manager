<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Student Manager - Students</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <?php
            require "helper-functions.php";

            if(!isset($_SESSION["user"])) {
                header("Location: $page");
                exit();
            }

            $students = [
                [
                    "id" => 1,
                    "name" => "Thommas Young",
                    "neptun" => "KMLT44",
                    "DOB" => "2005-04-30",
                    "gender" => "male",
                    "classes" => [
                        "Webprogramming",
                        "Discrete Mathematics",
                        "Linux Basics"
                    ]
                ],
                [
                    "id" => 2,
                    "name" => "Jim Old",
                    "neptun" => "ABC254",
                    "DOB" => "2000-04-27",
                    "gender" => "male",
                    "classes" => [
                        "Webprogramming",
                    ]
                ],
                [
                    "id" => 3,
                    "name" => "Greta Neither",
                    "neptun" => "LMO8MY",
                    "DOB" => "2003-02-07",
                    "gender" => "female",
                    "classes" => [
                        "Linux Basics",
                    ]
                ],
            ];

            $oldest_student = null;
            $oldest_timestamp = null;

            // Get oldest student
            foreach($students as $student) {
                $current_timestamp = strtotime($student["DOB"]); // number of seconds since Jan 1 1970

                if($oldest_timestamp == null || $current_timestamp < $oldest_timestamp) {
                    $oldest_timestamp = $current_timestamp;
                    $oldest_student = $student;
                }
            }
        ?>

        <nav class="navbar">
            <span>Student Manager</span>
            <ul>
                <li>
                    <a href="student-list.html" class="current">Students</a>
                </li>
                <li><a href="#">Add Student</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>
        <div class="container">
            <?php if(isset($_GET) && $_GET["registration"]): ?>
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
                            <td><?= $student["name"] ?></td>
                            <td><?= $student["neptun"] ?></td>
                            <td><?= $student["DOB"] ?></td>
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
                <p>Oldest Student:  <?= $oldest_student["name"] ?> with DOB <?= $oldest_student["DOB"] ?> (<?= calculate_age_from_DOB($oldest_student["DOB"]) ?> years old)</p>
                <p>Total Students: <?= count($students) ?></p>
            </div>
        </div>
    </body>
</html>