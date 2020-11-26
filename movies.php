<?php 
    session_start();

    if (!isset($_SESSION['role'])) {
        header('Location: ./index.php');
    } elseif ($_SESSION['role'] !== 'USER') {
        header('Location: ./welcome.php?error=noauth');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/b9ef111606.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/movies.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src='js/movies.js'></script>
    <title>Movies</title>
</head>
<body>
    <?php 
      require "components/navbar.php";
      require_once "php/errorNav.php";
    ?>
    <div class="container">
        <h1>MOVIES</h1>
        <form class="form-inline d-flex justify-content-center md-form active-cyan-2 mt-2">
            <input class="form-control form-control-md mr-3 w-75" type="text" placeholder="Search movies by Category, Cinema or Title.."
                aria-label="Search" name="search_term">
            <i class="fas fa-search" aria-hidden="true"></i>
            <div class="result w-100 "></div>
        </form>
        <div class="row">
            <div class="col-lg-6">
                <h2>What to <b>Watch?</b></h2>
            </div>
        </div>
        <section>
          <h3>Your <b>Favourites</b></h3><hr>
          <div class="favourites row row-cols-1 row-cols-md-5 float-center"></div>
        </section>
        <section class="mb-5">
          <h3>Movies</h3><hr>
          <div class="movies container"></div>
        </section>
    </div>
    <?php require "components/footer.php";?>

    <!-- Movie Modal -->
    <div id="movieModal" class="modal fade" role="dialog" style="opacity: 1;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="container py-5 px-10 mx-10">
          <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
              <div class="view overlay z-depth-1-half">
                <img src="" id="image" style="width: 100%;" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-md-6 mb-4 mb-md-0">
              <h3 id="title" class="font-weight-bold"></h3>
              <p id="cinema_name" class="text-muted"></p>
              <p id="dates" class="text-muted"></p>
              <p id="category" class="text-muted"></p>
              <div class="float-right mr-3 my-2 p-1">
                <i class="heart fa-heart" aria-hidden="true" id=""
                  data-toggle="tooltip" data-placement="top" title="I like it"
                  style="font-size: 25px; color: #ff8282 !important;"></i>
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>