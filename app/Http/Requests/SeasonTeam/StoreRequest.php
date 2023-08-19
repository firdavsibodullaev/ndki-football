<?php

namespace App\Http\Requests\SeasonTeam;

use App\DTOs\SeasonTeam\SeasonTeamDTO;
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
            'teams' => 'required|array|array_length:even',
            'teams.*' => ['required', 'int', Rule::exists('teams', 'id')]
        ];
    }

    public function toDto(): SeasonTeamDTO
    {
        return new SeasonTeamDTO($this->get('teams'));
    }
}
