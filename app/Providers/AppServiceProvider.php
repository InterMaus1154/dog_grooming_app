<?php

namespace App\Providers;

use App\Domain\Customer\Contracts\CustomerRepository;
use App\Infrastructure\Customer\CustomerEloquentRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, CustomerEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once  app_path('helpers.php');

        DB::prohibitDestructiveCommands(app()->isProduction());

        Event::listen(Login::class, function($event){
            activity('auth')->causedBy($event->user)->log('User logged in');
        });

    }
}
