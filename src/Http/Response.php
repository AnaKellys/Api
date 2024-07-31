<?php

namespace App\Http;

class Response
{
  public static function json(array $data, int $status = 200, array $headers = [])
  {
    http_response_code($status);

    header("Content-Type: application/json");

    echo json_encode($data);
  }
}