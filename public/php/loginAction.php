<?php
  if (isset($_POST['login-submit'])) {

    include_once '../config/database.php';
    include_once '../user/user.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    
    $username = $_POST['uname'];
    $password = $_POST['pwd'];

    if (empty($username) || empty($password)) {
      header("Location: ../index.php?error=emptyfields");
      exit();
    } else {
      $user->username = isset($_POST['uname'])? $_POST['uname']:die();
      $stmt = $user->getUserByUsrname();

      if ($user->id != null) {
        $verifiedPwd = password_verify($password, $user->password);

        if ($verifiedPwd == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();

        } else {
          if ($user->confirmed > 0) {
            session_start();
            $_SESSION['uid'] = $user->id;
            $_SESSION['name'] = $user->name;
            $_SESSION['lname'] = $user->surname;
            $_SESSION['role'] = $user->role;
            $_SESSION['conf'] = $user->confirmed;

            header("Location: ../welcome.php");
            exit();
          } else {
            header("Location: ../index.php?error=noconfirm");
            exit();
          }
        }
      } else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }
  }
 ?>