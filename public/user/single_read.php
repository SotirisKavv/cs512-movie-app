<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Acces-Control-Allow-Headers: Content-Type, Acces-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once './user.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new User($db);

    $item->username = (isset($_POST['username'])?$_POST['username']:die());

    $stmt = $item->getUserByUsrname();

    if($item->id != null){
        $usr_arr = array(
            "id" => $item->id,
            "name" => $item->name,
            "surname" => $item->surname,
            "username" => $item->username,
            "email" => $item->email,
            "role" => $item->role
        );

        http_response_code(200);
        echo json_encode($usr_arr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "User not found")
        );
    }

?>