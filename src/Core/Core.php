<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Core
{

  public static function dispatch(array $routes)
  {
    // filtro de rota
    // Se depois da barra tiver alguma coisa será considerada url.
    $url = '/';
    isset($_GET['url']) && $url .= $_GET['url'];

    $url !== '/' && $url = rtrim($url, '/');

    $prefixController = 'App\\Controllers\\';

    foreach ($routes as $route) {
      $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

      if (preg_match($pattern, $url, $matches)) {
        array_shift($matches);

        $routeFound = true;

        if ($route['method'] !== Request::method()) {
          Response::json([

            'message' => 'sorry, method not allowed.'
          ], 405);
          return;
        }

        [$controller, $action] = explode('@', $route['action']);



        try {
          $controller = $prefixController . $controller;
          $extendController = new $controller();
          $extendController->$action(new Request, new Response, $matches);
        } catch (\Throwable $th) {
          Response::json(['message' => $th->getMessage()], $th->getCode());
          // getMessage -> recebe mensagem.
          // getCode -> recebe código.
        }

        // print '<pre>';
        // print '</pre>';
      }
    }

    if (!$routeFound) {
      $controller = $prefixController . 'NotFoundController';
      $extendController = new $controller();
      $extendController->index(new Request, new Response);
    }
  }
}
