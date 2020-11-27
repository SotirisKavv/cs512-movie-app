<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    session_start();

    include_once '../config/database.php';
    include_once './movie.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $movie = new Movie($db);

    if (empty($_POST['id_u'])){
        $movie->title = $_POST['title'];
        $movie->releaseYear = $_POST['year'];
        $movie->posterLink = $_POST['poster_link'];
        $movie->startDate = formatDate($_POST['start_date']);
        $movie->endDate = formatDate($_POST['end_date']);
        $movie->cinemaId = $_POST['cinema_id'];
        $movie->category = $_POST['category'];
        
        if($movie->createMovie()){
            http_response_code(200);
            echo json_encode($movie);
        } else{
            http_response_code(404);
            echo json_encode("Movie could not be created!");
        }
    } else {
        $movie->id = $_POST['id_u'];
        $stmt = $movie->getMovieById();

        $movie->title = $_POST['title'];
        $movie->releaseYear = $_POST['year'];
        $movie->posterLink = $_POST['poster_link'];
        $movie->startDate = formatDate($_POST['start_date']);
        $movie->endDate = formatDate($_POST['end_date']);
        $movie->cinemaId = $_POST['cinema_id'];
        $movie->category = $_POST['category'];
        
        if($movie->updateMovie()){
            http_response_code(200);
            echo json_encode($movie);
        } else{
            http_response_code(404);
            echo json_encode("Movie not updated!");
        }
    }

    function formatDate($date) {
        list($day, $month, $year) = preg_split('/\//', $date);
        return "$year-$month-$day";
    }
?>