<?php
  session_start();

  if (isset($_SESSION['uname'])) {
    header("Location: ./index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/b9ef111606.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/signup.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Εγγραφθείτε τώρα σύντομα και απλά!</title>
  </head>
  <body>
    <?php require "./php/errorSignup.php";?>
    <div class="container">
      <form class="box form-inline d-flex justify-content-left md-form active-cyan-2 mt-2" action="./php/signupAction.php" method="post">
        <h1>Εγγραφή</h1>
        <div class="row w-100 mb-0 pb-0">
          <div class="form-group col-md mb-4">
            <input autocomplete="off" type="text" name="uname" placeholder="Username">
          </div>
        </div>
        <div class="row w-100 mb-0 pb-0">
          <div class="form-group col-md-6 mb-4">
            <input autocomplete="off" type="text" name="name" placeholder="Όνομα">
          </div>
          <div class="form-group col-md-6 mb-4">
            <input autocomplete="off" type="text" name="lname" placeholder="Επίθετο">
          </div>
        </div>
        <div class="row w-100 mb-0 pb-0">
          <div class="form-group col-md mb-4">
            <input autocomplete="off" type="email" name="email" placeholder="Email">
          </div>
        </div>
        <div class="row w-100 mb-0 pb-0">
          <div class="form-group col-md mb-4">
            <input autocomplete="off" type="password" name="pwd" placeholder="Κωδικός">
          </div>
        </div>
        <div class="row w-100 mb-0 pb-0">
          <div class="form-group col-md mb-4">
            <input autocomplete="off" type="password" name="pwd-rpt" placeholder="Επαναλάβετε τον κωδικό σας">
          </div>
        </div>
        <select name="role">
          <option value="USER">User</option>
          <option value="CINEMAOWNER">Cinema Owner</option>
          <option value="ADMIN">Administrator</option>
        </select>
        <input type="submit" name="signup-submit" value="Εγγραφή">
        <p>
          Έχεις ήδη λογαριασμό; Μπες <a href="./index.php">εδώ</a> και δες τις αποστολές σου!
        </p>
      </form>
    </div>
    <?php require "components/footer.php";?>
  </body>
</html>
