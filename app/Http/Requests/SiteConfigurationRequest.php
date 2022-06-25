<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $key
 * @property-read string $value
 */
class SiteConfigurationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string|min:3',
            'value' => 'required|string|min:3',
        ];
    }
}
