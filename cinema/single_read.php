<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Acces-Control-Allow-Headers: Content-Type, Acces-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once './cinema.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Cinema($db);

    $item->id = (isset($_POST['id'])?$_POST['id']:die());

    $stmt = $item->getCinemaById();

    if($item->name != null){
        $cnm_arr = array(
            "id" => $item->id,
            "name" => $item->name,
        );

        http_response_code(200);
        echo json_encode($cnm_arr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Cinema not found")
        );
    }

?>