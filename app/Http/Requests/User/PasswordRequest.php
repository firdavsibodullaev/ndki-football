<?php

namespace App\Http\Requests\User;

use App\DTOs\User\PasswordDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordRequest extends FormRequest
{
    protected $errorBag = 'password';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['string', 'confirmed', Password::default()],
        ];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return [
            'password' => __('Пароль')
        ];
    }

    public function toDto(): PasswordDTO
    {
        return new PasswordDTO(...$this->validated());
    }
}
