<?php
    session_start();

    if (!isset($_SESSION['role'])) {
        header('Location: ./index.php');
    } elseif ($_SESSION['role'] !== 'CINEMAOWNER') {
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
    <link rel="stylesheet" href="css/owner.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src='./js/owner.js'></script>
    <title>Cinema</title>
</head>
<body>
  <?php
    require "components/navbar.php";
    require_once "php/errorNav.php";
  ?>
  <div class="container">
    <div class="table-wrapper">
      <div class="container my-5">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-10">
              <h2>Manage <b>Cinemas</b> &amp; <b>Movies</b></h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <h2><b>Your Cinemas</b></h2>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>NAME</th>
              <th></th>
              <th>
                <button class="btn btn-success create_cinema"  style="float: right;">
                  <i class="fa fa-plus"></i>  Add Cinema
                </button>
              </th>
            </tr>
          </thead>
          <tbody class="text-white">
          </tbody>
        </table>
      </div>
    <div class="container mb-5">
      <div class="row mb-4">
        <div class="col-md-8">
          <h2><b>Your Movies</b></h2>
        </div>
        <div class="col-md-4">
          <button class="btn btn-success create_movie" style="float: right;">
            <i class="fa fa-plus"></i> Add Movie
          </button>
        </div>
      </div>
      <div class="owner_movies"></div>
    </div>
  </div>
  <?php require "components/footer.php";?>

  <!-- Modal Cinema HTML Form -->
  <div id="cinemaModal" class="modal fade" role="dialog" style="opacity: 1;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" id="cinema_form">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="id_u_cinema" name="id_u" class="form-control" required>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" id="button_action_cinema" class="btn btn-info">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Cinema Modal HTML -->
  <div id="deleteCinemaModal" class="modal fade" style="opacity: 1;">
    <div class="modal-dialog modal-dialog-centered danger">
      <div class="modal-content">
        <form method="post" id="deleteCinemaForm">
          <div class="modal-header">
            <h4 class="modal-title">Delete Cinema</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
            <div class="modal-body">
            <input type="hidden" id="id_d_cinema" name="id_d" class="form-control">
            <p>Are you sure you want to delete these Records?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-danger" value="Delete">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Movie HTML Form -->
  <div id="movieModal" class="modal fade" role="dialog" style="opacity: 1;">
    <div class="modal-dialog modal-dialog-centered" style="height: 100vh;">
      <div class="modal-content">
        <form method="post" id="movie_form">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Title</label>
              <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Release Year</label>
              <input type="text" id="year" name="releaseYear" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Poster Link</label>
              <input type="text" id="poster_link" name="posterLink" class="form-control">
            </div>
            <div class="form-group">
              <label>Start Date</label>
              <input type="text" id="start_date" name="startDate" class="form-control" required>
            </div>
            <div class="form-group">
              <label>End Date</label>
              <input type="text" id="end_date" name="endDate" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Cinema Name</label>
              <select id="cinema_id" name="cinemaId" class="form-control" required>
              </select>
            </div>
            <div class="form-group">
              <label>Category</label>
              <input type="text" id="category" name="category" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="id_u_movie" name="id_u" class="form-control" required>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" id="button_action_movie" class="btn btn-info">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Movie Modal HTML -->
  <div id="deleteMovieModal" class="modal fade" style="opacity: 1;">
    <div class="modal-dialog modal-dialog-centered danger">
      <div class="modal-content">
        <form method="post" id="deleteMovieForm">
          <div class="modal-header">
            <h4 class="modal-title">Delete Movie</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
            <div class="modal-body">
            <input type="hidden" id="id_d_movie" name="id_d" class="form-control">
            <p>Are you sure you want to delete these Records?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-danger" value="Delete">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
