<?php 

namespace Uspdev;

use Illuminate\Support\ServiceProvider;

class UspdevValidatorProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages, $customAttributes)
        {
            $messages += $this->getMessages();
            return new UspdevValidator($translator, $data, $rules, $messages, $customAttributes);
        });
    }

    protected function getMessages()
    {
        return [
            'codpes' => 'Não é um número USP válido',
            'graduacao' => 'Número USP não é de um(a) aluno(a) de graduação',
        ];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){}

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
