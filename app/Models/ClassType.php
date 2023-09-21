<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClassType extends Model
{
    use HasFactory;

    // relationships
    public function ScheduledClasses(): HasMany
    {
        return $this->hasMany(ScheduledClass::class, 'class_type_id');
    }
}
