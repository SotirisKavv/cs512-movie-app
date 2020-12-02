<?php

    include_once './config/database.php';
    include_once './user/user.php';

    $database = new Database();
    $conn = $database->getConnection();

    $user = new User($conn);

    $data = $user->getUsers();
    $count = $data->rowCount();

    if ($count < 1) {

        $user->name = "name";
        $user->surname = "surname";
        $user->username = "username";
        $user->password = password_hash('nimda', PASSWORD_DEFAULT);
        $user->email = "admin@movie.com";
        $user->role = "ADMIN";
        $user->confirmed = true;

        if(!($user->createUser())){
            echo 'User could not be created.';
        }

    }
?>
