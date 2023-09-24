<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UsernameOrEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        if (preg_match('/^[a-zA-Z0-9_]+$/', $value)) {
            return;
        }

        $fail(__($this->message()));
    }

    public function message()
    {
        return 'The :attribute must be a valid email or username.';
    }
}
