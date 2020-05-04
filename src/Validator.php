<?php

namespace Uspdev;

use Illuminate\Validation\Validator as BaseValidator;
use Uspdev\Replicado\Pessoa;

class Validator extends BaseValidator
{
    protected function validateCodpes($attribute, $value)
    {
       if (!(is_numeric(trim($value)))) {
            return false;
        }
        if(empty(Pessoa::dump($value))) {
            return false;
        }
        return true;
    }
}
