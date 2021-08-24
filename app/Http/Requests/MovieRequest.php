<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //?
        // Validations are moved to policy.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $movie = $this->route()->parameter('movie');

        // Create Rules.
        $rules = [
            'title' => "required|unique:App\Models\Movie",
            'duration' => 'required|int|max:255',
            'director' => 'required',
        ];

        // Update rules.
        if ($movie) {
            $rules = [
                'title' => "required|unique:App\Models\Movie,title,$movie->id",
            ];
        }

        return $rules;
    }
}
