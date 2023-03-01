<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ValidStakeAddressRule implements Rule
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

        $stakeAddressResponse = Http::retry(5, 100)->timeout(5)->post('https://api.koios.rest/api/v0/account_info', [
            '_stake_addresses' => [$value]
        ]);

        $stakeAddressInfo = (array) json_decode($stakeAddressResponse->body());

        if ($stakeAddressInfo) {
            return true;
        } else {
            return false;
        }

        /*  DBSYNC solution
        $dbStakeAddress = DB::connection('dbsymc')
            ->table('stake_address')
            ->where('view', '=', $value)
            ->first();

        if ($dbStakeAddress) {
            return true;
        } else {
            return false;
        }
        */

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The input has to be a valid stake address!';
    }
}
