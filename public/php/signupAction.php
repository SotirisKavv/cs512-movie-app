<?php
  if (isset($_POST['signup-submit'])) {

    require '../config/database.php';
    include_once '../user/user.php';

    $username = $_POST['uname'];
    $surname = $_POST['lname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $passwordRpt = $_POST['pwd-rpt'];
    $role = $_POST['role'];

    $database = new Database();
    $db = $database->getConnection();

    if (empty($username) || empty($email) || empty($password) || empty($passwordRpt) || empty($name) || empty($surname) || empty($role)) {
      header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
      exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=invalidmail&uname=".$username);
      exit();
    } elseif (!preg_match('/^[a-zA-Z0-9$:?.~^_]{6,}$/', $password)) {
      header("Location: ../signup.php?error=6charsorpassword&uname=".$username."&mail=".$email);
      exit();
    }elseif ($password !== $passwordRpt) {
      header("Location: ../signup.php?error=invalid_password&uname=".$username."&mail=".$email);
      exit();
    } else {
      $user = new User($db);

      $user->username = $username;
      $stmt = $user->getUserByUsrname();

      if ($user->id != null) {
        header("Location: ../signup.php?error=usernameTaken&mail=".$email);
        exit();
      } else {
        $user->name = $name;
        $user->username = $username;
        $user->surname = $surname;
        $user->email = $email;
        $user->role = $role;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->confirmed = 0;

        if ($user->createUser()) {
          header("Location: ../index.php");
          exit();
        } else {
          header("Location: ../signup.php?error=SQLerror");
          exit();
        }
      }
    }
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>
