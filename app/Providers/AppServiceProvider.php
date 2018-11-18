<?php

namespace BAKD\Providers;

use Illuminate\Support\Facades\Log;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use \Pusher\Pusher;


class LaravelLoggerProxy {
    public function log( $msg ) {
        Log::info($msg);
    }
}

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pusher = $this->app->make(\Pusher\Pusher::class, ['auth_key' => env('PUSHER_APP_KEY'), 'secret' => env('PUSHER_APP_SECRET'), 'app_id' => env('PUSHER_APP_ID')]);
        $pusher->set_logger( new LaravelLoggerProxy() );

        if ($this->app->runningUnitTests()) {
            Schema::defaultStringLength(191);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
