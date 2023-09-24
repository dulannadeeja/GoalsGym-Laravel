<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\ScheduledClass;
use App\Models\User;
use App\Policies\ScheduledClassPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
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
        Gate::define('admin-only', fn() => auth()->user()->role->name === 'admin');
        Gate::define('member-only', fn() => auth()->user()->role->name === 'member');

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return 'http://localhost/reset-password/' . $token . '?email=' . $user->email;
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
                return (new MailMessage)
                    ->greeting('Hello!' . $notifiable->name)
                    ->subject('Verify Your Email Address for ' . config('app.name'))
                    ->line('You are receiving this email because you created an account on ' . config('app.name') . '.')
                    ->line('Please click the button below to verify your email address.')
                    ->action('Verify Email Address', $url)
                    ->line('If you did not create an account, no further action is required.');
        });
    }
}
