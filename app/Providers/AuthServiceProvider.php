<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\ScheduledClass;
use App\Policies\ScheduledClassPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ScheduledClass::class => ScheduledClassPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('instructor-only', fn() => auth()->user()->role->name === 'instructor');
    }
}
