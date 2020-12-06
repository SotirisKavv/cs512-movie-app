<?php

//includes
include_once '../config/database.php';
include_once '../objects/cinema.php';

class CinemaController
{
  //main object
  private $cinema;

  function __construct()
  {
    $database = new Database();
    $conn = $database->getConnection();
    $this->cinema = new Cinema($conn);
  }

  //read single cinema
  function readOneCinema($id)
  {
    //get cinema from db
    $this->cinema->id = $id;
    $this->cinema->getCinemaById();

    if($this->cinema->name)
    {
      //encode data to array
      $cnm_arr = array(
          "id" => $this->cinema->id,
          "name" => $this->cinema->name,
      );

      //response 200 - OK
      http_response_code(200);
      echo json_encode($cnm_arr);

    } else
    {
      //response 404 - Not found
      http_response_code(404);
      echo json_encode(array("message" => "Cinema does not exist."));
    }
  }

  //read all cinemas owned by user
  function readCinemas($uid)
  {
    //get cinemas based on user id
    $this->cinema->ownerId = $uid;
    $stmt = $this->cinema->getOwnersCinemas();
    $itemCount = $stmt->rowCount();

    //check if there are more than 0
    if($itemCount > 0){

      //encode data into array
      $cnmArr = array();
      $cnmArr['body'] = array();

      //retrieve data
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $c = array(
              "id" => $id,
              "name" => $name
          );
          array_push($cnmArr['body'], $c);
      }

      //response 200 - OK
      http_response_code(200);
      echo json_encode($cnmArr);

    } else {

      //response 404 - Not Found
      http_response_code(404);
      echo json_encode(
          array("message" => "No cinema found for this uid.")
      );

    }
  }

  // create or update cinema
  function saveCinema($uid)
  {
    //get $_POST data
    $data = json_decode(file_get_contents("php://input"));

    //check if there is a cinema id
    //if there is not, create cinema. Otherwise update.
    if (empty($data->id_u))
    {

      //check if fields are empty
      if (!empty($data->name))
      {
        //set cinema props
        $this->cinema->name = $data->name;
        $this->cinema->ownerId = $uid;

        //create cinema
        if($this->cinema->createCinema())
        {
          //response 201 - Created
          http_response_code(201);
          echo json_encode($this->cinema);

        } else
        {
          //respnse 503 - Service Unavailable
          http_response_code(503);
          echo json_encode(array("message" => "Cinema could not be created"));
        }
      } else
      {
        //respnse 400 - Bad request
        http_response_code(400);
        echo json_encode(array("message" => "Cinema could not be created. There were empty fields!"));
      }

    } else
    {
      //check if fields are empty
      if (!empty($data->name))
      {
        //get cinema by id
        $this->cinema->id = $data->id_u;
        $this->cinema->getCinemaById();

        //update info
        $this->cinema->name = $data->name;

        //update cinema
        if($this->$cinema->updateCinema())
        {
          //response 200 - OK
          http_response_code(200);
          echo json_encode(array("message" => "Cinema was updated"));

        } else
        {
          //respnse 503 - Service Unavailable
          http_response_code(503);
          echo json_encode(array("message" => "Cinema could not be updated"));
        }
      } else
      {
        //respnse 400 - Bad request
        http_response_code(400);
        echo json_encode(array("message" => "Cinema could not be updated. There were empty fields!"));
      }

    }
  }

  //delete cinema
  function deleteCinema($id)
  {

    //set id to be deleted
    $this->cinema->id = $id;

    //delete cinema
    if ($this->cinema->deleteCinema())
    {
      //response 200 - OK
      http_response_code(200);
      echo json_encode(array("message" => "Cinema deleted successfully."));

    } else
    {
      //response 503 - Service Unavailable
      http_response_code(503);
      echo json_encode(array("message" => "Cinema could not be deleted."));
    }
  }

}

?>
