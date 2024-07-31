<?php

namespace App\Http\Exceptions;

class InternalServerErrorException extends \DomainException
{
  public function __construct(string $message = "Internal Server Error", int $code = 500)
  {
    parent::__construct($message, $code);
  }
}