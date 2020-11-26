<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    session_start();

    include_once '../config/database.php';
    include_once './movie.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Movie($db);

    $items->ownerId = $_SESSION['uid'];
    $stmt = $items->getOwnersMovies();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $mvArr = array();
        $mvArr['body'] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            
            $m = array(
                "id" => $id,
                "title" => $title,
                "releaseYear" => $release_year,
                "posterLink" => $poster_link,
                "startDate" => $start_date,
                "endDate" => $end_date,
                "cinemaName" => $cinema_name,
                "category" => $category
            );
            array_push($mvArr['body'], $m);
        }
        echo json_encode($mvArr);
    } else {
        http_response_code(200);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>