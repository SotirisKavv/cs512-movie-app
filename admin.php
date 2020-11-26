<?php 
    session_start();

    if (!isset($_SESSION['role'])) {
        header('Location: ./index.php');
    } elseif ($_SESSION['role'] !== 'ADMIN') {
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
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src='./js/admin.js'></script>
  <title>Admin</title>
</head>
<body>
  <?php 
    require "components/navbar.php";
    require_once "php/errorNav.php";
  ?>
  <div class="container">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row my-5">
          <div class="col-sm-6">
            <h2>Manage <b>Users</b></h2>
	        </div>
        </div>
        <table class="table table-striped table-hover mb-5">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>NAME</th>
              <th>USERNAME</th>
              <th>EMAIL</th>
              <th>ROLE</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php require "components/footer.php";?>

  <!-- Modal HTML Form -->
  <div id="editUserModal" class="modal fade" role="dialog" style="opacity: 1;">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <form method="post" id="editForm">
          <div class="modal-header">						
            <h4 class="modal-title">Edit User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Surname</label>
              <input type="text" id="surname" name="surname" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select id="role" name="role" class="form-control" required>
                <option value="USER">User</option>
                <option value="CINEMAOWNER">Cinema Owner</option>
                <option value="ADMIN">Administrator</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="id_u" name="id_u" class="form-control" required>					
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-info" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal HTML -->
  <div id="deleteUserModal" class="modal fade" style="opacity: 1;">
    <div class="modal-dialog modal-dialog-centered danger">
      <div class="modal-content">
        <form method="post" id="deleteForm">					
          <div class="modal-header">						
            <h4 class="modal-title">Delete User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
            <div class="modal-body">
            <input type="hidden" id="id_d" name="id_d" class="form-control">					
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