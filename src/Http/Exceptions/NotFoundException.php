<?php

namespace App\Http\Exceptions;

class NotFoundException extends \DomainException
{
  public function __construct(string $message = "Not Found", int $code = 404)
  {
    parent::__construct($message, $code);
  }
}

// DomainException class do php