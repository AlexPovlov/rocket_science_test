<?php

namespace App\Http\Requests;

use App\Rules\RussianPhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:250'],
            'middle_name' => ['nullable', 'string', 'max:250'],
            'last_name' => ['required', 'string', 'max:250'],
            'phone' => ['required', 'string', 'max:250', 'unique:App\Models\User,phone', new RussianPhoneRule],
            'email' => ['required', 'string', 'max:250', 'unique:App\Models\User,email', 'email'],
            'password' => ['required', 'string', 'max:250', 'confirmed', Password::min(6)->mixedCase()->symbols()],
        ];
    }
}
