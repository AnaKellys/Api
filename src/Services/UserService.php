<?php

namespace App\Services;

use App\Http\Exceptions\DatabaseException;
use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\UnauthorizedException;
use App\Http\JWT;
use App\Models\User;
use App\Utils\Validator;
use PDOException;

class UserService
{
  public static function create(array $data)
  {
    try {
      $fields = Validator::validate(['name', 'email', 'password'], $data);

      $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

      $email = User::verifyEmail($fields['email']);

      // print gettype($email);
      // die();

      if ($email) throw new UnauthorizedException('Sorry, this user already exists');

      $user = User::save($fields);

      if (!$user) throw new UnauthorizedException('Sorry, we could not create your account.');

      return "User created successfully!";
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public static function auth(array $data)
  {
    try {
      $fields = Validator::validate(['email', 'password'], $data);

      $user = User::authentication($fields);

      if (!$user) throw new UnauthorizedException('Sorry, we could not authentication you.');

      // print_r($user);
      return JWT::generate($user);
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public static function fetch(mixed $authorization)
  {
    try {
      if (isset($authorization['error'])) return ['error' => $authorization['error']];

      $userFromJWT = JWT::verify($authorization);


      if (!$userFromJWT) return ['error' => 'Please, login to acess this resource.'];

      $user = User::find($userFromJWT['id']);

      if (!$user) return ['error' => 'Sorry, we could not find your account.'];

      return $user;
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public static function update(mixed $authorization, array $data)
  {
    try {
      if (isset($authorization['error'])) return ['error' => $authorization['error']];

      $userFromJWT = JWT::verify($authorization);

      if (!$userFromJWT) return ['error' => 'Please, login to access this resource.'];

      $fields = Validator::validate(['name'], $data);

      $verifyName = User::verifyName($fields['name']);

      if ($verifyName) throw new UnauthorizedException('Sorry, the user has already been modified');

      // print gettype($verifyName);
      // die();

      $user = User::update($userFromJWT['id'], $fields);

      if (!$user) return ['error' => 'Sorry, we could not update your account.'];

      return "User update successfully!";
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }

  public static function delete(mixed $authorization, int|string $id)
  {
    try {
      if (isset($authorization['error'])) return ['error' => $authorization['error']];

      $userFromJWT = JWT::verify($authorization);

      if (!$userFromJWT) return ['error' => 'Please, login to access this resource.'];

      $user = User::delete($id);

      if (!$user) throw new DatabaseException('Sorry, we could not delete your account.');

      return "User delete successfully!";
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }
}














