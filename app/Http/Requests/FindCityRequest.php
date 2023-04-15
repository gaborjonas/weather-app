<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindCityRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:35',
        ];
    }

    public  function messages(): array
    {
        return [
            'name.required' => 'Please enter a city',
            'name.min' => 'Please enter more than 2 characters',
            'name.max' => 'Please enter fewer than 35 characters',
        ];
    }
}
