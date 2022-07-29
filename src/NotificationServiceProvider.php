<?php

namespace ConfettiCode\Inertiajs\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        Message::factory(function () {
            return new Message($this->app['request']);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/js' => resource_path('js/Inertiajs/Notifications'),
        ], 'inertiajs-notifications');
    }
}
