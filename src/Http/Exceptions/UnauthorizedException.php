<?php

namespace App\Http\Exceptions;

class UnauthorizedException extends \DomainException
{
  public function __construct(string $message = "Unauthorized", int $code = 401)
  {
    parent::__construct($message, $code);
  }
} 