<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once './cinema.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $cinema = new Cinema($db);
    
    $cinema->id = (isset($_POST['id_d'])?$_POST['id_d']:die());
    $stmt = $cinema->getCinemaById();
    
    if($cinema->deleteCinema()){
        http_response_code(200);
        echo json_encode("Cinema deleted!");
    } else{
        http_response_code(404);
        echo json_encode("Cinema couldn't be deleted!");
    }
?>