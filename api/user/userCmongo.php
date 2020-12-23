<?php

//includes
include_once '../config/mongoDb.php';
include_once '../mongoObjects/user.php';

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
    $rec = $this->user->getUsers();
    $itemCount = count($rec);

    //check if there are more than 0
    if($itemCount > 0){

      //response 200 - OK
      http_response_code(200);
      echo json_encode(iterator_to_array($rec));

    } else {

      //response 404 - Not Found
      http_response_code(404);
      echo json_encode(
          array("message" => "No user was found.")
      );

    }
  }

  //create a user
  function createUser()
  {
    $data = json_decode(file_get_contents("php://input"), true);

    $res = $this->user->createUser($data);

    if ($res->getInsertedCount() == 1) {

      //response 201 - created
      http_response_code(201);
      echo json_encode(array("message" => "User created successfully."));

    } else {

      //response 503 - Service Unavailable
      http_response_code(503);
      echo json_encode(array("message" => "User could not be created."));

    }
  }

    function updateUser()
    {
      $data = json_decode(file_get_contents("php://input", true));

      $fields = $data->{'fields'};
      $set_values = array();

      foreach ($fields as $key => $fields) {
      	$arr = (array)$fields;
      	foreach ($fields as $key => $value) {
      		$set_values[$key] = $value;
      	}
      }

      //_id field value
      $id = $data->{'where'};

      $result = $this->$user->updateUser($id);

      if ($result->getModifiedCount() == 1) {

        //response 201 - created
        http_response_code(201);
        echo json_encode(
    		  array("message" => "Record successfully updated")
    	  );
      } else {

        //response 503 - Service Unavailable
        http_response_code(503);
        echo json_encode(
          array("message" => "Error while updating record")
        );
      }
    }

}

?>
