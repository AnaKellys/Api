<?php 

namespace App\Utils;

class Validator
{

  public static function validate(array $fields, array $values)
  {
    foreach ($fields as $field) {
      if (!isset($values[$field]) || empty(trim($values[$field]))) {
        throw new \Exception("the field ($field) is required");
      }
    }
    return $values;
  }

}
// isset -> verifica se o valor do array foi definido.
// empty -> verifica se o valor é vazio.
// trim -> remove espaços.