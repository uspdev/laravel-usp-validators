<?php

namespace Uspdev;

use Illuminate\Support\Facades\Validator as BaseValidator;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado\Graduacao;
use Uspdev\Replicado\Bempatrimoniado;

class UspdevValidator extends BaseValidator
{
    public function codpes($attribute, $value, $parameters)
    {
       if (!(is_numeric(trim($value)))) {
            return false;
        }
        if(empty(Pessoa::dump($value))) {
            return false;
        }
        return true;
    }

    public function graduacao($attribute, $value) {
        $unidade = getenv('REPLICADO_CODUNDCLG');
        return Graduacao::verifica($value, $unidade);
    }

    public function patrimonio($attribute, $value) {
        return Bempatrimoniado::verifica($value);
    }
}
