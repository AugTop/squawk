<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class range implements Rule
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
        return (($value < 9000) && ($value > 8000)) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value of your squawk cannot be between 8000 and 9000';
    }
}
