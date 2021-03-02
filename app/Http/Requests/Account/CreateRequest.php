<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Authorize this
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ( auth()->check () ) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'username' => ['required', 'alpha_dash', 'unique:users', 'max:255'],
            'password' => ['required', 'min:6'],
        ];
    }
}
