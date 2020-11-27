<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once './user.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new User($db);

    $stmt = $items->getUsers();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $usrArr = array();
        $usrArr['body'] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $u = array(
                "id" => $id,
                "name" => $name,
                "surname" => $surname,
                "username" => $username,
                "password" => $password,
                "email" => $email,
                "role" => $role,
                "confirmed" => $confirmed
            );
            array_push($usrArr['body'], $u);
        }
        echo json_encode($usrArr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>