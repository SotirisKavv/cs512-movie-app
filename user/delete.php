<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once './user.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);
    
    $user->id = (isset($_POST['id_d'])?$_POST['id_d']:die());
    $stmt = $user->getUserById();
    
    if($user->deleteUser()){
        http_response_code(200);
        echo json_encode("User deleted!");
    } else{
        http_response_code(404);
        echo json_encode("User couldn't be deleted!");
    }
?>