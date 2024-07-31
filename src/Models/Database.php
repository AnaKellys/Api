<?php

namespace App\Models;
use App\Http\Exceptions\DatabaseConnectionException;
use App\Http\Exceptions\DatabaseException;

class Database
{

  public static function getConnection()
  {

    try {
      $host = 'localhost';
      $port = '5432';
      $dbname = 'minimercado';
      $username = 'ana';
      $password = 'abc123';

      $pdo = new \PDO("pgsql:host=$host;port=$port;dbname=$dbname", "$username", "$password", [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_PERSISTENT => false]);

      return $pdo;
    } catch (\PDOException $e) {
      if ($e->errorInfo[0] === '08006') {
        throw new DatabaseConnectionException('Sorry, we could not connect to the database');
      }

      throw new DatabaseException($e->getMessage());
    }
  }
}
