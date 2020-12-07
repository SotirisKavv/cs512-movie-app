<?php

//includes
include_once '../config/database.php';
include_once '../objects/user.php';

class UserController
{
  //main object
  private $user;

  function __construct()
  {
    $database = new Database();
    $conn = $database->getConnection();
    $this->user = new User($conn);
  }

  //read single user
  function readOneUser($id)
  {
    //get user from db
    $this->user->id = $id;
    $this->user->getUserById();

    if($this->user->id)
    {
      //encode data to array
      $usr_arr = array(
          "id" => $this->user->id,
          "name" => $this->user->name,
          "surname" => $this->user->surname,
          "username" => $this->user->username,
          "email" => $this->user->email,
          "role" => $this->user->role
      );

      //response 200 - OK
      http_response_code(200);
      echo json_encode($usr_arr);

    } else
    {
      //response 404 - Not found
      http_response_code(404);
      echo json_encode(array("message" => "User does not exist."));

    }
  }

  //read all users
  function readUsers()
  {
    //get users
    $stmt = $this->user->getUsers();
    $itemCount = $stmt->rowCount();

    //check if there are more than 0
    if($itemCount > 0){

      //encode data into array
      $usrArr = array();
      $usrArr['body'] = array();

      //retrieve data
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $u = array(
              "id" => $id,
              "name" => $name
          );
          array_push($usrArr['body'], $u);
      }

      //response 200 - OK
      http_response_code(200);
      echo json_encode($usrArr);

    } else {

      //response 404 - Not Found
      http_response_code(404);
      echo json_encode(
          array("message" => "No user was found.")
      );

    }
  }

}

?>
