<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UsernameFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/^[a-zA-Z0-9_]+$/', $value)) {
            return;
        }

        $fail(__($this->message()));
    }

    public function message(): string
    {
        return 'The :attribute must be a valid username. Only letters, numbers, and underscores are allowed.';
    }
}
