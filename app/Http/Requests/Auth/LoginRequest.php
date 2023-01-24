<?php

namespace App\Http\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => ['required','string','max:255', 'starts_with:BAR_,FOO_,BAZ_'],
            'password' => ['required','string'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'system' => explode('_', $this->login)[0]
        ]);
    }
}
