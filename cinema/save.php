<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    session_start();

    include_once '../config/database.php';
    include_once './cinema.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $cinema = new Cinema($db);

    if (empty($_POST['id_u'])){
        $cinema->name = $_POST['name'];
        $cinema->ownerId = $_SESSION['uid'];
        
        if($cinema->createCinema()){
            http_response_code(200);
            echo json_encode($cinema);
        } else{
            http_response_code(200);
            echo json_encode("Cinema could not be created!");
        }
    } else {
        $cinema->id = $_POST['id_u'];
        $stmt = $cinema->getCinemaById();

        $cinema->name = $_POST['name'];
        
        if($cinema->updateCinema()){
            http_response_code(200);
            echo json_encode($cinema);
        } else{
            http_response_code(200);
            echo json_encode("Cinema not updated!");
        }
    }
?>