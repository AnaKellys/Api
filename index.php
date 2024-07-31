<?php

var_dump($_SERVER['REQUEST_URI']);

// phpinfo();

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/routes/main.php";

use App\Core\Core;
use App\Http\Route;
// prefixo, modulo e classe.


try {
  Core::dispatch(Route::routes());
} catch (\Throwable $th) {
  print $th->getMessage();
  print "\n";
  print $th->getFile();
  print "\n";
  print $th->getLine();
}
