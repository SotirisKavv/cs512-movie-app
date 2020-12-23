<?php

//includes
include_once '../config/database.php';
include_once '../objects/movie.php';
include_once '../objects/cinemas.php';

class MovieController
{
  //main object
  private $movie;
  private $cinema;

  function __construct()
  {
    $database = new Database();
    $conn = $database->getConnection();
    $this->movie = new Movie($conn);
    $this->cinema = new Cinema($conn);
  }

  //read single movie
  function readOneMovie($id)
  {
    //get movie from db
    $this->movie->id = $id;
    $this->movie->getMovieById();

    if($this->movie->title)
    {
      //encode data to array
      $mv_arr = array(
          "id" => $this->movie->id,
          "title" => $this->movie->title,
          "release_year" => $this->movie->releaseYear,
          "poster_link" => $this->movie->posterLink,
          "start_date" => $this->movie->startDate,
          "end_date" => $this->movie->endDate,
          "cinema_name" => $this->movie->cinemaName,
          "category" => $this->movie->category,
          "fav" => $this->movie->fav==0

      //response 200 - OK
      http_response_code(200);
      echo json_encode($mv_arr);

    } else
    {
      //response 404 - Not found
      http_response_code(404);
      echo json_encode(array("message" => "Movie does not exist."));
    }
  }

  //read all movies owned by user
  function readOwnersMovies($uid)
  {
    //get movies based on user id
    $this->movie->ownerId = $uid;
    $stmt = $this->movie->getOwnersMovies();
    $itemCount = $stmt->rowCount();

    //check if there are more than 0
    if($itemCount > 0){

      //encode data into array
      $mvArr = array();
      $mvArr['body'] = array();

      //retrieve data
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $m = array(
              "id" => $id,
              "title" => $title,
              "releaseYear" => $release_year,
              "posterLink" => $poster_link,
              "startDate" => $start_date,
              "endDate" => $end_date,
              "cinemaName" => $cinema_name,
              "category" => $category
          );
          array_push($mvArr['body'], $m);
      }

      //response 200 - OK
      http_response_code(200);
      echo json_encode($mvArr);

    } else {

      //response 404 - Not Found
      http_response_code(404);
      echo json_encode(array("message" => "No movie found for this uid."));

    }
  }

  //read favourites of user
  function readFavourites($uid)
  {
    //get favourite movies based on user id
    $stmt = $this->movie->getUsersFavourites($uid);
    $itemCount = $stmt->rowCount();

    //check if more than 0
    if($itemCount > 0){

      //encode date into array
      $mvArr = array();
      $mvArr['body'] = array();

      //retrieve data
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $m = array(
              "id" => $id,
              "title" => $title,
              "releaseYear" => $release_year,
              "posterLink" => $poster_link,
              "startDate" => $start_date,
              "endDate" => $end_date,
              "cinemaName" => $cinema_name,
              "category" => $category
          );

          array_push($mvArr['body'], $m);
      }

      //response 200 - OK
      http_response_code(200);
      echo json_encode($mvArr);

    } else {

      //response 404 - Not Found
      http_response_code(200);
      echo json_encode(array("message" => "No Favourite Movies were found."));
    }
  }

  //read movies played today
  function readTodays()
  {
    //get movies played today
    $stmt = $this->movie->getTodaysMovies();
    $itemCount = $stmt->rowCount();

    //check if more than 0
    if($itemCount > 0){

        //encode data into array
        $mvArr = array();
        $mvArr['body'] = array();

        //retrieve data
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $m = array(
                "id" => $id,
                "title" => $title,
                "releaseYear" => $release_year,
                "posterLink" => $poster_link,
                "startDate" => $start_date,
                "endDate" => $end_date,
                "cinemaName" => $cinema_name,
                "category" => $category
            );

            array_push($mvArr['body'], $m);
        }

        //response 200 - OK
        http_response_code(200)
        echo json_encode($mvArr);

    } else {

        //response 404 - Not Found
        http_response_code(404);
        echo json_encode(array("message" => "No Movies played today found."));

    }
  }

  //read all movies
  function readMovies()
  {
    //get all cinemas
    $stmtCin = $this->cinema->getCinemas();
    $cinemaCount = $stmtCin->rowCount();

    //check if more than 0
    if($cinemaCount > 0){

      //encode data into array
      $Arr = array();
      $Arr['cinemas'] = array();

      //retrieve cinemas
      while ($rowCin = $stmtCin->fetch(PDO::FETCH_ASSOC)){
        extract($rowCin);

        //get movies by cinema name
        $this->movie->cinemaName = $name;
        $stmtMov = $this->movie->getMoviesByCinemaName();
        $movCount = $stmtMov->rowCount();

        //encode data into array in case of none
        $cinema = array(
            "name" => $name,
            "movies" => array()
        );

        //check if more than 0
        if ($movCount > 0) {

          //retrieve movies per cinema
          while ($rowMov = $stmtMov->fetch(PDO::FETCH_ASSOC)){
            extract($rowMov);
            $m = array(
                "movie_id" => $id,
                "title" => $title,
                "releaseYear" => $release_year,
                "posterLink" => $poster_link,
                "startDate" => $start_date,
                "endDate" => $end_date,
                "category" => $category,
                "cinemaName" => $name
            );

            array_push($cinema['movies'], $m);
          }

          array_push($Arr['cinemas'], $cinema);
        }
      }

      //response 200 - OK
      http_response_code(200);
      echo json_encode($Arr);

    } else {

      //response 404 - Not Found
      http_response_code(404);
      echo json_encode(array("message" => "No record found."));

    }
  }

  //search a movie by props
  function searchMovie($search_term)
  {
    //get movies by props
    $stmt = $this->movie->getMoviesByField($search_term);
    $itemCount = $stmt->rowCount();

    //check if more than 0
    if($itemCount > 0){

      //encode data into array
      $mvArr = array();
      $mvArr['body'] = array();

      //retrive data
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $m = array(
            "id" => $id,
            "title" => $title,
            "releaseYear" => $release_year,
            "posterLink" => $poster_link,
            "startDate" => $start_date,
            "endDate" => $end_date,
            "cinemaName" => $cinema_name,
            "category" => $category
        );

        array_push($mvArr['body'], $m);
      }

      //response 200 - OK
      http_response_code(200);
      echo json_encode($mvArr);

    } else {

      //response 404 - Not Found
      http_response_code(404);
      echo json_encode(array("message" => "No movie found."));

    }
  }

  //toggle favourite
  function toggleFav($uid)
  {
    //get $_POST data
    $data = json_decode(file_get_contents("php://input"));

    //check if action is add to favs
    if ($data->action=='add') {

      //set movie id
      $this->movie->id = $data->id;

      if($this->movie->addFavourite($uid)){

        //response 201 - created
        http_response_code(201);
        echo json_encode(array("message" => "Movie added to favourites."));

      } else {

        //response 503 - Service Unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Movie couldn't be added to favourites."));

      }
    } else {

      //set movie id
      $this->movie->id = $data->id;

      if($item->deleteFavourite($uid)){

        //response 201 - created
        http_response_code(201);
        echo json_encode(array("message" => "Movie added to favourites."));

      } else {

        //response 503 - Service Unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Movie couldn't be added to favourites."));

      }
    }
  }

  // create or update movie
  function saveMovie($uid)
  {
    //get $_POST data
    $data = json_decode(file_get_contents("php://input"));

    //check if there is a movie id
    //if there is not, create movie. Otherwise update.
    if (empty($data->id_u))
    {
      //check if fields are empty
      if (!empty($data->title) && !empty($data->year) &&
          !empty($data->start_date) && !empty($data->end_date) &&
          !empty($data->cinema_id) && !empty($data->category)
        )
      {
        //set movie props
        $this->movie->title = $data->title;
        $this->movie->releaseYear = $data->year;
        $this->movie->posterLink = $data->poster_link;
        $this->movie->startDate = formatDate($data->start_date);
        $this->movie->endDate = formatDate($data->end_date);
        $this->movie->cinemaId = $data->cinema_id;
        $this->movie->category = $data->category;

        //create cinema
        if($this->movie->createCinema())
        {
          //response 201 - Created
          http_response_code(201);
          echo json_encode($this->movie);

        } else
        {
          //respnse 503 - Service Unavailable
          http_response_code(503);
          echo json_encode(array("message" => "Movie could not be created"));
        }
      } else
      {
        //respnse 400 - Bad request
        http_response_code(400);
        echo json_encode(array("message" => "Movie could not be created. There were empty fields!"));
      }

    } else
    {
      //check if fields are empty
      if (!empty($data->title) && !empty($data->year) &&
          !empty($data->start_date) && !empty($data->end_date) &&
          !empty($data->cinema_id) && !empty($data->category)
        )
      {
        //get movie by id
        $this->movie->id = $data->id_u;
        $this->movie->getMovieById();

        //update info
        $this->movie->title = $data->title;
        $this->movie->releaseYear = $data->year;
        $this->movie->posterLink = $data->poster_link;
        $this->movie->startDate = formatDate($data->start_date);
        $this->movie->endDate = formatDate($data->end_date);
        $this->movie->cinemaId = $data->cinema_id;
        $this->movie->category = $data->category;

        //update movie
        if($this->movie->updateMovie()
        {
          //response 200 - OK
          http_response_code(200);
          echo json_encode(array("message" => "Movie was updated"));

        } else
        {
          //respnse 503 - Service Unavailable
          http_response_code(503);
          echo json_encode(array("message" => "Movie could not be updated"));

        }
      } else
      {
        //respnse 400 - Bad request
        http_response_code(400);
        echo json_encode(array("message" => "Movie could not be updated. There were empty fields!"));

      }
    }

  }

  //delete movie
  function deleteMovie($id)
  {

    //set id to be deleted
    $this->movie->id = $id;

    //delete cinema
    if ($this->movie->deleteMovie())
    {
      //response 200 - OK
      http_response_code(200);
      echo json_encode(array("message" => "Movie deleted successfully."));

    } else
    {
      //response 503 - Service Unavailable
      http_response_code(503);
      echo json_encode(array("message" => "Movie could not be deleted."));

    }
  }

  //format date string into sql-friendly structure
  function formatDate($date)
  {
      list($day, $month, $year) = preg_split('/\//', $date);
      return "$year-$month-$day";
  }

}

?>
