<?php

namespace App\Http\Requests\User;

use App\DTOs\User\UpdateDTO;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $errorBag = 'user';

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'username' => ['string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
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
        ];
    }

    public function toDto(): UpdateDTO
    {
        return new UpdateDTO(...$this->validated());
    }
}
