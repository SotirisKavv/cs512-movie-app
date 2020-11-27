<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once './movie.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $movie = new Movie($db);
    
    $movie->id = (isset($_POST['id_d'])?$_POST['id_d']:die());
    $stmt = $movie->getMovieById();
    
    if($movie->deleteMovie()){
        http_response_code(200);
        echo json_encode("Movie deleted!");
    } else{
        http_response_code(404);
        echo json_encode("Movie couldn't be deleted!");
    }
?>