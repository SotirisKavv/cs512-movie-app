<?php

/**
 * DB configuration to connect MongoDB with PHP & Apache server
 */
class Database
{

  //Database configuration
  private $host = 'mongodb';
  private $port = '27017';

  //connection object
  public conn;

  function getConnection()
  {
    try {
      $this->conn = new MongoDB\Driver\Manager('mongodb://'.$this->host.':'.$this->port);
    } catch (MongoDBDriverExceptionException $e) {
      echo $e->getMessage();
      echo nl2br("n");
    }

  }
}


?>
