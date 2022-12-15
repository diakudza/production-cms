<?php

namespace App\Rules;

use App\Enums\UserRole;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UserRoleRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        foreach (UserRole::cases() as $item) {
            if ($item->name == $value) {
                return;
            }
        }
        $fail("Такой роли нет");
    }
}
