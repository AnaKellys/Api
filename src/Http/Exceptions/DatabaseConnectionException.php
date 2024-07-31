<?php

namespace App\Http\Exceptions;

class DatabaseConnectionException extends \DomainException
{
  public function __construct(string $message = "database connection", int $code = 503)
  // código que indica quando nossa rede não pode se conectar ao seu servidor para comunicação.
  {
    parent::__construct($message, $code);
  }
}