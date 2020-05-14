<?php

namespace Uspdev;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class UspdevValidatorProvider extends ServiceProvider
{
    public function register(){}

    public function boot()
    {
        Validator::extend('codpes', '\Uspdev\UspdevValidator@codpes');
        Validator::replacer('codpes', function ($message, $attribute, $rule, $parameters) {
            return 'Número USP não é válido';
        });

        Validator::extend('graduacao', '\Uspdev\UspdevValidator@graduacao');
        Validator::replacer('graduacao', function ($message, $attribute, $rule, $parameters) {
            return 'Este número USP não é de um(a) aluno(a) de graduação';
        });

        Validator::extend('patrimonio', '\Uspdev\UspdevValidator@patrimonio');
        Validator::replacer('patrimonio', function ($message, $attribute, $rule, $parameters) {
            return 'Não é um número de patrimonio ativo';
        });
    }
}
