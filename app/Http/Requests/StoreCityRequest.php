<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:cities|min:2|max:35',
        ];
    }

    /**
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter a city',
            'name.unique' => 'You already have added this city',
            'name.min' => 'Please enter more than 2 characters',
            'name.max' => 'Please enter fewer than 35 characters',
        ];
    }
}
