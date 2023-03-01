<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ValidTickerRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $responsePools = Http::retry(5, 100)->timeout(5)->get('https://api.koios.rest/api/v0/pool_list?ticker=eq.'.strtoupper($value));
        $pools = (array) json_decode($responsePools->body());
        if ($pools) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The input has to be a valid pool ticker.';
    }
}
