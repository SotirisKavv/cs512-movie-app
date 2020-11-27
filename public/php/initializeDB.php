<?php

    header("Access-Control-Allow-Origin: *");
    include_once './config/database.php';
    include_once './user/user.php';

    $database = new Database();
    $conn = $database->getConnection();

     $sql_users = "CREATE TABLE IF NOT EXISTS Users (
        id INT NOT NULL auto_increment,
        name VARCHAR(255),
        surname VARCHAR(255),
        username VARCHAR(255),
        password VARCHAR(255),
        email VARCHAR(255),
        role ENUM('ADMIN', 'CINEMAOWNER', 'USER'),
        confirmed BOOLEAN,
        PRIMARY KEY (id)
        );";

    $sql_movies = "CREATE TABLE IF NOT EXISTS Movies (
        id INT NOT NULL auto_increment,
        title VARCHAR(255),
        release_year INT,
        poster_link varchar(255),
        start_date DATE,
        end_date DATE,
        cinema_id VARCHAR(255),
        category VARCHAR(255),
        PRIMARY KEY (id), 
        FOREIGN KEY (cinema_id) REFERENCES Cinemas(id) ON DELETE CASCADE
        );";

    $sql_favourites = "CREATE TABLE IF NOT EXISTS Favourites (
          user_id INT,
          movie_id INT,
          FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
          FOREIGN KEY (movie_id) REFERENCES Movies(id) ON DELETE CASCADE
        );";
        
    $sql_cinemas = "CREATE TABLE IF NOT EXISTS Cinemas (
          id INT NOT NULL auto_increment,
          owner_id INT,
          name VARCHAR(255),
          PRIMARY KEY (id),
          FOREIGN KEY (owner_id) REFERENCES Users(id) ON DELETE CASCADE
        );";

    if (!$conn->query($sql_users) || !$conn->query($sql_movies) 
        || !$conn->query($sql_favourites) || !$conn->query($sql_cinemas)) {
        echo "Error creating Table: " . $conn->error;
    }

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

        if($user->createUser()){
            echo 'User created successfully.';
        } else{
            echo 'User could not be created.';
        }

    }
?>
