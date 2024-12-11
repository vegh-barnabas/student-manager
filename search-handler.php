<?php
    require "helper-functions.php";
    require "storage.php";

    $parameters = $_GET;

    if (!empty($parameters["neptun"])) {
        $user_storage = new Storage(new JsonIO("users.json"));
        $user = $user_storage->findOne(["neptun" => $parameters["neptun"]]);

        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "User not found"]);
        }
    } else {
        echo json_encode(["error" => "Neptun code is required"]);
    }
?>