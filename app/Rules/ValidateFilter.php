<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateFilter implements Rule
{
    protected $columns;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($columns)
    {
        $this->columns = $columns;
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
        // get columns name
        $filters = array_keys($value);
        
        // validate columns
        $decision = collect($filters)->diff($this->columns);

        // validate values

        //results
        return $decision->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.filters');
    }
}
