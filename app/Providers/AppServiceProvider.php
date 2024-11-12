<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Invitation;
use App\Policies\EventPolicy;
use App\Policies\InvitationPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
        Invitation::class => InvitationPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
