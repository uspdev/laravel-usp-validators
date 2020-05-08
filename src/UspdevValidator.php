<?php

namespace Uspdev;

use Illuminate\Validation\Validator as BaseValidator;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado\Graduacao;

class UspdevValidator extends BaseValidator
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

    protected function validateGraduacao($attribute, $value) {
        /* Enquanto não corrigimos o replicado para pegar a unidade
         * pela variavél de ambiente, vou fixar essa validação na FFLCH
         * */
        return Graduacao::verifica($value, 8);
    }
}
