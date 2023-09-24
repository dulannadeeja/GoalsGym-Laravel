<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username', // add username to fillable
        'password',
        'role_id',
        'provider',
        'provider_id',
        'provider_token',
        'provider_refresh_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // relationships

    public function scheduledClasses(): HasMany
    {
        return $this->hasMany(ScheduledClass::class, 'instructor_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(ScheduledClass::class,'bookings','user_id','scheduled_class_id');
    }

    // get user role name
    public function getRoleNameAttribute(): string
    {
        return $this->role->name;
    }

    // generate username from nickname and name
    public static function generateUsername($name, $nickname=null): string
    {
        $username = null;
        if ($nickname) {
            $username = strtolower($nickname);
        }
        else {
            // Convert the name to lowercase and remove spaces
            $username = strtolower(str_replace(' ', '', $name));
        }

        // If the username exists, add a numeric suffix to make it unique
        $suffix = 1;
        while (self::isUsernameTaken($username)) {
            $suffix++;
            $username = $username . $suffix;
        }

        return $username;
    }

    // check if the username is already taken
    public static function isUsernameTaken($username)
    {
        return self::where('username', $username)->exists();
    }

    // generate password
    public static function generatePassword()
    {
        $password = Str::password(10);
        return $password;
    }
}
