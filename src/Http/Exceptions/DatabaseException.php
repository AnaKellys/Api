<?php

namespace App\Http\Exceptions;

class DatabaseException extends \DomainException
{
  public function __construct(string $message = "already exists", int $code = 500)
  // erro no servidor
  {
    parent::__construct($message, $code);
  }
}
