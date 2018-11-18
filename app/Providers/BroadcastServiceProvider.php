<?php

namespace BAKD\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Broadcast::routes(["middleware" => ["jwt:auth"]]);

        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
