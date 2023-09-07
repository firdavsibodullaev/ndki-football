<?php

namespace App\Http\Requests\User;

use App\DTOs\User\PasswordDTO;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordRequest extends FormRequest
{
    protected $errorBag = 'password';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['string', 'confirmed', Password::default()],
        ];
    }

    public function toDto(): PasswordDTO
    {
        return new PasswordDTO(...$this->validated());
    }
}
