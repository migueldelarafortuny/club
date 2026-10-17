<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SeasonInRange implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $thisYear = date('Y');
        if($value < 1931 || $value > $thisYear+1) {
            $fail('La temporada debe estar entre 1931 y ' . ($thisYear + 1) . '.');
        }
    }
}
