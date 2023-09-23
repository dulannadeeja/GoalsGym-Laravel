<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScheduledClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'class_type_id',
        'started_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    // relationships
    public function classType(): BelongsTo
    {
        return $this->belongsTo(ClassType::class, 'class_type_id');
    }
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function bookedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'bookings','scheduled_class_id','user_id');
    }

    // query scopes
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('started_at', '>', now());
    }

    public function scopeNotBookedByUser(Builder $query, User $user): Builder
    {
        return $query->whereDoesntHave('bookedUsers', fn ($query) => $query->where('user_id', $user->id));
    }
}
