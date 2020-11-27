<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    session_start();

    include_once '../config/database.php';
    include_once './cinema.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Cinema($db);

    $items->ownerId = $_SESSION['uid'];
    $stmt = $items->getOwnersCinemas();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $cnmArr = array();
        $cnmArr['body'] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $c = array(
                "id" => $id,
                "name" => $name
            );
            array_push($cnmArr['body'], $c);
        }
        echo json_encode($cnmArr);
    } else {
        http_response_code(200);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>