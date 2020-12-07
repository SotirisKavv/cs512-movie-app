<?php

//REST API vars
$db_service = "http://172.18.1.6:3306";

//outh2 vars
$auth_service = "http://172.18.1.5:3005";
$auth_basic = "MzgwNjI5NzYtYWFlOC00NjkxLWEyMTEtNjEzOTcyNjAxMjM2OjNhZDYyZDYxLTliMDUtNGY0Zi04YjQ2LTA0MDczMTZiZjhhNw==";

$client_id = "38062976-aae8-4691-a211-613972601236";

$httpcode = 0;

//set timezone
date_default_timezone_set("Europe/Athens");

//make API calls with cURL
function callAPI($method, $url, $data, $header)
{
  $curl = curl_init($url);

  switch ($method) {
    case 'POST':
      curl_setopt($curl, CURLOPT_POST, 1);
      if ($data) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      }
      break;

    case 'PUT':
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      if ($data) {
        curl_setopt($curl, CURL_POSTFIELDS, $data);
      }
      break;

    case 'DELETE':
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
      break;

    default:
      if ($data) {
        $url = sprintf("%s?%s", $url, http_build_query($data));
      }
      break;
  }

  curl_setopt($curl, CURLOPT_HTTP_VERSION, CURLOPT_HTTP_VERSION_1_1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  if ($header) {
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  }

  $result = curl_exec($curl);
  $globals['httpcode'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  curl_close($curl);

  return $result;
}

?>
