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

        Validator::extend('multiple_codpes', '\Uspdev\UspdevValidator@multiple_codpes');
        Validator::replacer('multiple_codpes', function ($message, $attribute, $rule, $parameters) {
            return 'Números USPs não são vãlidos';
        });

        Validator::extend('graduacao', '\Uspdev\UspdevValidator@graduacao');
        Validator::replacer('graduacao', function ($message, $attribute, $rule, $parameters) {
            return 'Este número USP não é de um(a) aluno(a) de graduação';
        });

        Validator::extend('patrimonio', '\Uspdev\UspdevValidator@patrimonio');
        Validator::replacer('patrimonio', function ($message, $attribute, $rule, $parameters) {
            return 'Não é um número de patrimonio ativo';
        });

        Validator::extend('multiple_patrimonio', '\Uspdev\UspdevValidator@multiple_patrimonio');
        Validator::replacer('multiple_patrimonio', function ($message, $attribute, $rule, $parameters) {
            return 'Não são números de patrimônios ativos ou válidos';
        });
    }
}
