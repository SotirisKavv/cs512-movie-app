<?php
  //
  include_once 'callAPI.php';

  $res = callAPI('GET', $db_service.'/api/user', false, false);

  if ($res['message']) {
    callAPI('POST', $db_service.'/api/user', ,false);
  }
?>
