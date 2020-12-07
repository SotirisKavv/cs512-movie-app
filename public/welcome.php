<?php
  session_start();

  // if (!isset($_SESSION['role']) || $_SESSION['conf']==0) {
  //   header("Location: ./index.php");
  // }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/b9ef111606.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src='js/welcome.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome</title>
  </head>
  <body>
    <?php
      require "components/navbar.php";
      require_once "php/errorNav.php";
    ?>
    <div class="container">
      <div class="jumbotron mt-3 mb-5">
        <h2 class="mb-3"><b>Welcome!</b></h2>
        <div class="container">
          <h3 class="mb-2"><b>Playing</b> today</h3>
          <div class="todays_movies row row-cols-1 row-cols-md-5 float-center"></div>
        </div>
      </div>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
