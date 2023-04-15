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
}
