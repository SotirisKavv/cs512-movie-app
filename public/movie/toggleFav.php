<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Acces-Control-Allow-Headers: Content-Type, Acces-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once './movie.php';

    session_start();

    $database = new Database();
    $db = $database->getConnection();

    $item = new Movie($db);

    if ($_POST['action']=='add') {
        $item->id = (isset($_POST['id'])?$_POST['id']:die());
        
        if($item->addFavourite($_SESSION['uid'])){
            http_response_code(200);
            echo json_encode("Movie added!");
        } else{
            http_response_code(404);
            echo json_encode("Movie couldn't be added!");
        }
    } else {
        $item->id = (isset($_POST['id'])?$_POST['id']:die());
        
        if($item->deleteFavourite($_SESSION['uid'])){
            http_response_code(200);
            echo json_encode("Movie deleted!");
        } else{
            http_response_code(404);
            echo json_encode("Movie couldn't be deleted!");
        }
    }
?>