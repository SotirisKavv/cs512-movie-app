<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    session_start();

    include_once '../config/database.php';
    include_once './movie.php';
    include_once '../cinema/cinema.php';

    $database = new Database();
    $db = $database->getConnection();

    $cinemas = new Cinema($db);
    $movies = new Movie($db);

    $stmtCin = $cinemas->getCinemas();
    $cinemaCount = $stmtCin->rowCount();

    if($cinemaCount > 0){
        
        $Arr = array();
        $Arr['cinemas'] = array();

        while ($rowCin = $stmtCin->fetch(PDO::FETCH_ASSOC)){
            extract($rowCin);

            $movies->cinemaName = $name;
            $stmtMov = $movies->getMoviesByCinemaName();
            $movCount = $stmtMov->rowCount();

            $cinema = array(
                "name" => $name,
                "movies" => array()
            );

            if ($movCount > 0) {
                while ($rowMov = $stmtMov->fetch(PDO::FETCH_ASSOC)){

                    extract($rowMov);
                    
                    $m = array(
                        "movie_id" => $id,
                        "title" => $title,
                        "releaseYear" => $release_year,
                        "posterLink" => $poster_link,
                        "startDate" => $start_date,
                        "endDate" => $end_date,
                        "category" => $category,
                        "cinemaName" => $name
                    );

                    array_push($cinema['movies'], $m);
                }
                array_push($Arr['cinemas'], $cinema);
            }
        }
        echo json_encode($Arr);
    } else {
        http_response_code(200);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>