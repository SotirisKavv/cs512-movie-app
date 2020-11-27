<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/b9ef111606.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css">
        <title>Movie App</title>
    </head>
    <body>
        <?php include_once "./php/initializeDB.php"; ?>
        <?php require "./php/errorLogin.php"; ?>
        <div class="container">
            <form class="box" action="./php/loginAction.php" method="post">
                <h1>Σύνδεση</h1>
                <div class="area">
                    <i class="fa fa-user"></i>
                    <input autocomplete="off" type="text" name="uname" placeholder="Username">
                </div>
                <div class="area">
                    <i class="fa fa-lock"></i>
                    <input autocomplete="off" type="password" name="pwd" placeholder="Κωδικός">
                </div>
                <input type="submit" name="login-submit" value="Συνδέσου">
                <p>
                    Δεν έχεις λογαριασμό; Μπες <a href="./signup.php">εδώ</a> και κάνε την εγγραφή σου τώρα!
                </p>
            </form>
        </div>
        <?php require "components/footer.php";?>
    </body>
</html>