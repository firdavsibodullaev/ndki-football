<?php

namespace App\Http\Requests\Team;

use App\DTOs\TeamDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'logo' => 'nullable|file|image:jpg,jpeg,png,svg|max:' . (1024 * 5),
            'is_active' => 'required|boolean'
        ];
    }

    public function toDto(): TeamDTO
    {
        return new TeamDTO(...$this->validated());
    }
}
