<?php

//start session
if (!$_SESSION)
{
  session_start();
}

//header options
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//include User controller with db and user obj
include_once 'userC.php';

//parse url into arr
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

//request info
$requestMethod = $_SERVER['REQUEST_METHOD'];
$uid = $_REQUEST['uid'];

//based on request info, execute CRUD action
if ($uri[2] == 'user')
{
  $ctrl = new UserController();

  switch ($requestMethod) {
    case 'GET':
      //check action
      if ($uid) {
        $ctrl->readOneUser($uid);
      } else {
        $ctrl->readUsers();
      }
      break;

    default:
      http_response_code(404);
      header("HTTP/1.1 404 Not Found");
      echo json_encode(array("message" => "Invalid method!"));
      break;
  }
}
?>
