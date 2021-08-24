<?php

namespace App\Rules\Api;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class MovieRules implements Rule
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
     * Create general rules.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public static function generalRules(Request $request) : array
    {
        return [
                'duration' => 'required|int|max:125',
                'director' => 'required|max:125',
            ];
    }

    /**
     * Create store rules.
     *
     * @param \Illuminate\Http\Request $request
     * @param int id
     * @return array
     */
    public static function storeRules(Request $request) : array
    {
        return self::generalRules($request) + [
                'title' => "required|unique:App\Models\Movie",
            ];
    }

    /**
     * Create update rules.
     *
     * @param \Illuminate\Http\Request $request
     * @param int id
     * @return array
     */
    public static function updateRules(Request $request, $id) : array
    {
        return self::generalRules($request) + [
                'title' => "required|unique:App\Models\Movie,title,$id",
            ];
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
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
