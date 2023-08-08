<?php

namespace App\Http\Requests\Player;

use App\DTOs\Player\PlayerDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'patronymic' => 'required|string|max:100',
            'team_id' => [
                'required',
                'int',
                Rule::exists('teams', 'id')
            ],
            'number' => 'required|int|digits_between:1,3',
            'avatar' => [
                'nullable',
                'file',
                'image',
                'mimes:jpg,jpeg,png,svg',
                'max:' . (1024 * 3)
            ]
        ];
    }

    public function toDto(): PlayerDTO
    {
        return new PlayerDTO(...$this->validated());
    }
}
