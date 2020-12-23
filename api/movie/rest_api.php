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

//include Movie controller with db and movie obj
include_once 'movieC.php';

//parse url into arr
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

//request info
$requestMethod = $_SERVER['REQUEST_METHOD'];
$cid = $_REQUEST['mid'];
$uid = $_SESSION['uid'];

//based on request info, execute CRUD action
if ($uri[2] == 'movie')
{
  $ctrl = new CinemaController();

  switch ($requestMethod) {
    case 'GET':
      //check action
      if ($uri[3] == 'search') {
        $keyword = isset($_REQUEST['s']) ? $_REQUEST['s'] : "";
        $ctrl->searchMovie();

      } elseif ($uri[3] == 'today') {
        $ctrl->readTodays();

      } elseif ($uri[3] == 'favourites') {
        $ctrl->readFavourites($uid);

      } elseif ($uri[3] == 'all') {
        $ctrl->readMovies();

      } else {
        if ($mid) {
          $ctrl->readOneMovie($mid);
        } else {
          $ctrl->readOwnersMovies($uid);
        }

      }
      break;

    case 'POST':
      if ($uri[3] == 'favourite') {
        $ctrl->toggleFav($uid);

      } else {
        $ctrl->saveMovie($uid);

      }
      break;

    case 'PUT':
      $ctrl->saveCinema($uid);
      break;

    case 'DELETE':
      $ctrl->deleteCinema($cid);
      break;

    default:
      http_response_code(404);
      header("HTTP/1.1 404 Not Found");
      echo json_encode(array("message" => "Invalid method!"));
      break;
  }
}
?>
