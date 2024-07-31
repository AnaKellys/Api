<?php

namespace App\Http;

class Request
{

  public const METHOD_GET = 'GET';
  public const METHOD_POST = 'POST';
  public const METHOD_PUT = 'PUT';
  public const METHOD_DELETE = 'DELETE';



  public static function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  } 
  
  public static function body()
  {
    $json = json_decode(file_get_contents("php://input"), true) ?? [];

    $data = match(self::method()) {
      'GET' => $_GET,
      'POST', 'PUT', 'DELETE' => $json,
    };
    return $data;
  }

  public static function authorization()
  {
    $authorization = getallheaders();

    if (!isset($authorization['Authorization'])) return ['error' => 'No authorization header provided'];

    $authorizationPartials = explode(' ', $authorization['Authorization']);

    if (count($authorizationPartials) !=2) return ['error' => 'Plase, provide a valid authorization header'];

    return $authorizationPartials[1] ?? '';
  }
    
}