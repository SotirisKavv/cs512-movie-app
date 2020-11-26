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
    
    $user->id = (isset($_POST['id_u'])?$_POST['id_u']:die());
    $stmt = $user->getUserById();

    $user->name = $_POST['name'];
    $user->surname = $_POST['surname'];
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->role = $_POST['role'];
    
    if($user->updateUser()){
        http_response_code(200);
        echo json_encode($user);
    } else{
        http_response_code(404);
        echo json_encode("user not updated");
    }
?>