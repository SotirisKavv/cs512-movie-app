<?php
  //include api call function
  include_once 'callApi.php';

  $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $parts = parse_url($url);
  parse_str($parts['query'], $query);

  //if log-in through form
  if (isset($_POST['login-submit']) && !isset($_SESSION)) {

    // setting the header
    $header = array("Host: idm",
                    "Authorization: Basic ".$auth_basic,
                    "Content-Type: application/x-www-form-urlencoded");

    // setting the data to aquire access token
    $data = "grant_type=password&username=".$_POST['uname']
            ."&password=".$_POST['pwd'];

    // call keyrock API
    $response = callAPI("POST", $auth_service.'/oauth2/token', $data, $header);
    $response = json_decode($response, true); //associative array

    //if response contains 'access_token', user has been verified
    if ($response['access_token']) {
      session_start();

      // setting session variables useful to connect with proxy
      $_SESSION["type"] = "oauth2";
      $_SESSION["access_token"] = $response['access_token'];
      $_SESSION["refresh_token"] = $response['refresh_token'];
      $_SESSION["token_type"] = $response['token_type'];
      $_SESSION["loggedin"] = true;

      // get user's info
      $response = callAPI('GET', $auth_service.'/user?access_token='.$_SESSION['access_token'], false, false);
      $response = json_decode($response, true); //associative array

      // storing user's info into session variables
      $_SESSION["username"] = $response['username'];
      $_SESSION["username"] = $response['username'];
      $_SESSION["role"] = $response['roles'][0]['name'];
      $_SESSION["id"] = $response['id'];

      header("location: ../welcome.php");

    } else {
      header("location: ../index.php");
      exit;
    }
    // if log in through connect with keyrock
  } elseif ($query['code'] && !isset($_SESSION)) {

    // setting the header
    $header = array("Host: idm",
                    "Authorization: Basic ".$auth_basic,
                    "Content-Type: application/x-www-form-urlencoded");

    // setting the data to aquire access token
    $data = "grant_type=authorization_code&code=".$query['code']."&redirect_uri=http://localhost:8080/php/loginAction.php";

    // call keyrock API
    $response = callAPI("POST", $auth_service.'/oauth2/token', $data, $header);
    $response = json_decode($response, true); //associative array

    //if response contains 'access_token', user has been verified
    if ($response['access_token']) {
      session_start();

      // setting session variables useful to connect with proxy
      $_SESSION["type"] = "oauth2";
      $_SESSION["access_token"] = $response['access_token'];
      $_SESSION["refresh_token"] = $response['refresh_token'];
      $_SESSION["token_type"] = $response['token_type'];
      $_SESSION["loggedin"] = true;

      // get user's info
      $response = callAPI('GET', $auth_service.'/user?access_token='.$_SESSION['access_token'], false, false);
      $response = json_decode($response, true); //associative array

      // storing user's info into session variables
      $_SESSION["username"] = $response['username'];
      $_SESSION["username"] = $response['username'];
      $_SESSION["role"] = $response['roles'][0]['name'];
      $_SESSION["id"] = $response['id'];

      header("location: ../welcome.php");

    } else {
      header("location: ../index.php");
      exit;
    }

    //if not logged in, redircet to index
  } elseif (!isset($_SESSION["loggedin"]) || isset($_SESSION["loggedin"]) !== true) {
      header("location: index.php");
      exit;
  }
 ?>
