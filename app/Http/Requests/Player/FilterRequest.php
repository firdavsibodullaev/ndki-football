<?php

namespace App\Http\Requests\Player;

use App\DTOs\Player\PlayerFilterDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'team_id' => 'nullable|int'
        ];
    }

    public function toDto(): PlayerFilterDTO
    {
        return new PlayerFilterDTO(...$this->validated());
    }
}
