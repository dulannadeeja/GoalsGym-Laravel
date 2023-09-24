<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessAccountCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class AuthProviderController extends Controller
{

    public function __construct()
    {

    }

    public function callBack(string $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $this->handleSocialLogin($user, $provider);
            return redirect()->route('dashboard')->with('success', 'You have successfully logged in.');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @throws \Exception
     */
    private function handleSocialLogin($user, $provider): void
    {
        // Check if the user exists with the same email
        $existingUserProvider = $this->checkIfUserExists($user->email);

        if ($existingUserProvider) {
            if ($existingUserProvider !== $provider) {
                throw new \Exception('You already have an account with us. Please sign in with ' . $existingUserProvider . '.');
            }
            Auth::login(User::where('email', $user->email)->first());
        }

        // Generate a password for the user
        $password = User::generatePassword();

        // Create or update the user
        $userModel = User::updateOrCreate(
            ['email' => $user->email],
            [
                'provider_id' => $user->id,
                'role_id' => User::whereHas('role', function ($query) {
                    $query->where('name', 'member');
                })->first()->id,
                'name' => $user->name,
                'username' => User::generateUsername($user->name, $user->nickname),
                'email' => $user->email,
                'password' => $password,
                'provider' => $provider,
                'provider_token' => $user->token,
                'provider_refresh_token' => $user->refreshToken,
                'email_verified_at' => now(),
            ]
        );

        // Send the user an email with their password
        ProcessAccountCreated::dispatch($userModel, $password);
        Auth::login($userModel);
    }

    private function checkIfUserExists($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return $user->provider;
        }
        return null;
    }
}
