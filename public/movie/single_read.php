<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Acces-Control-Allow-Headers: Content-Type, Acces-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once './movie.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Movie($db);

    $item->id = (isset($_POST['id'])?$_POST['id']:die());

    $stmt = $item->getMovieById();

    if($item->title != null){
        $mv_arr = array(
            "id" => $item->id,
            "title" => $item->title,
            "release_year" => $item->releaseYear,
            "poster_link" => $item->posterLink,
            "start_date" => $item->startDate,
            "end_date" => $item->endDate,
            "cinema_name" => $item->cinemaName,
            "category" => $item->category,
            "fav" => $item->fav==0
        );

        http_response_code(200);
        echo json_encode($mv_arr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Movie not found")
        );
    }

?>