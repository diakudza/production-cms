<?php

namespace App\Rules;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UserStatusRule implements InvokableRule
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
        foreach (UserStatus::cases() as $item) {
            if ($item->name == $value) {
                return;
            }
        }
        $fail("Такого статуса нет");
    }
}
