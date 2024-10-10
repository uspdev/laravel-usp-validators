<?php

namespace Uspdev;

use Illuminate\Support\Facades\Validator as BaseValidator;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado\Graduacao;
use Uspdev\Replicado\Bempatrimoniado;

class UspdevValidator extends BaseValidator
{

    /**
     * Recebe uma string com 1 número USP separados por vírgula e
     * retorna true caso a pessoa existaa. Também retorna
     * true para campos vazio
     */
    public function codpes($attribute, $value, $parameters)
    {
        if(empty(trim($value))) return true;

        if (!(is_numeric(trim($value)))) {
            return false;
        }
        if(empty(Pessoa::dump($value))) {
            return false;
        }
        return true;
    }

    /**
     * Recebe uma string com números USP separados por vírgula e
     * retorna true caso todas pessoas existam. Também retorna
     * true para campos vazio
     */
    public function muliple_codpes($attribute, $value, $parameters)
    {
        if(empty(trim($value))) return true;

        $multiple = array_map('trim', explode(',', $value));
        foreach($multiple as $codpes) {
            if (!(is_numeric($codpes))) {
                return false;
            }
            if(empty(Pessoa::dump($codpes))) {
                return false;
            }
        }
        return true;
    }

    public function graduacao($attribute, $value, $parameters) {
        if(empty(trim($value))) return true;

        $unidade = getenv('REPLICADO_CODUNDCLG');
        return Graduacao::verifica($value, $unidade);
    }

    public function alunoconvenioint($attribute, $value, $parameters) {
        if(empty(trim($value))) return true;

        $unidade = getenv('REPLICADO_CODUNDCLG');
        return Graduacao::verificarAlunoConvenioInt($value, $unidade);        
    }

    public function patrimonio($attribute, $value, $parameters) {
        if(empty(trim($value))) return true;

        return Bempatrimoniado::verifica($value);
    }

    public function multiple_patrimonio($attribute, $value, $parameters) {
        if(empty(trim($value))) return true;

        $multiple = array_map('trim', explode(',', $value));
        foreach($multiple as $patrim) {
            if(!Bempatrimoniado::verifica($patrim)) return false;
        }
        return true;
    }
}
