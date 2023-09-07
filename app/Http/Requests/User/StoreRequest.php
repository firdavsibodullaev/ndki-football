<?php

namespace App\Http\Requests\User;

use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UserDTO;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'username' => ['string', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', 'string', Password::default()],
            'role' => ['required', new Enum(Role::class)]
        ];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return [
            'name' => __('Имя'),
            'username' => __('Логин'),
            'password' => __('Пароль'),
            'role' => __('Роль'),
        ];
    }

    public function toDto(): UserDTO
    {
        return new UserDTO(
            name: $this->input('name'),
            username: $this->input('username'),
            password: new PasswordDTO(
                password: $this->input('password')
            ),
            role: Role::tryFrom($this->input('role'))
        );
    }
}
