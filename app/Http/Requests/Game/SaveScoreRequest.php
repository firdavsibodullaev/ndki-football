<?php

namespace App\Http\Requests\Game;

use App\DTOs\Game\SaveScoreDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveScoreRequest extends FormRequest
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
            'home_goal' => 'required|int|digits_between:1,11',
            'away_goal' => 'required|int|digits_between:1,11'
        ];
    }

    public function toDto(): SaveScoreDTO
    {
        return new SaveScoreDTO(...$this->validated());
    }
}
