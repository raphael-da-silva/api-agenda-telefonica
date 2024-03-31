<?php

namespace App\Providers;

use App\Http\Controllers\AgendaNamesController;
use App\Models\AgendaModel;
use Laravel\Lumen\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {   
        $this->app->bind(AgendaModel::class, function(){
            return new AgendaModel();
        });

        $this->app->bind(AgendaNamesController::class, function(Application $app){
            return new AgendaNamesController($app->make(AgendaModel::class));
        });
    }
}
