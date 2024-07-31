<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;

class UserController
{
  public function store(Request $request, Response $response)
  {
    $body = $request::body();

    $userService = UserService::create($body);

    $response::json([
      'data' => $userService
    ], 201);
  }

  public function login(Request $request, Response $response)
  {
    $body = $request::body();

    $userService = UserService::auth($body);

    $response::json([
      'jwt' => $userService
    ], 201);
    return;
  }

  public function fetch(Request $request, Response $response)
  {
    $authorization = $request::authorization();

    $userService = UserService::fetch($authorization);


    $response::json([
      'jwt' => $userService
    ], 201);
    return;
  }

  public function update(Request $request, Response $response)
  {
    $authorization = $request::authorization();

    $body = $request::body();

    $userService = UserService::update($authorization, $body);

    $response::json([
      'message' => $userService
    ], 201);
    return;
  }

  public function remove(Request $request, Response $response, array $id)
  {
    $authorization = $request::authorization();

    $userService = UserService::delete($authorization, $id[0]);

    $response::json([
      'message' => $userService
    ], 201);
    return;
  }
}
