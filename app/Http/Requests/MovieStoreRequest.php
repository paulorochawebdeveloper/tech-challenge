<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'year' => ['required', 'numeric', 'min:1900', 'max:2500'],
            'synopsis' => [],
            'runtime' => ['required', 'numeric'],
            'released_at' => ['required', 'date'],
            'cost' => ['required', 'numeric'],
            'genre_id' => ['required', 'exists:genres,id'],
        ];
    }
}
