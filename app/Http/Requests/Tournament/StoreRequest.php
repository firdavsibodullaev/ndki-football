<?php

namespace App\Http\Requests\Tournament;

use App\DTOs\Tournament\TournamentDTO;
use App\Enums\TournamentType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
            'name' => ['required', 'string', 'max:100', Rule::unique('tournaments', 'name')],
//            'type' => ['required', 'string', new Enum(TournamentType::class)],
            'is_home_away' => 'nullable|boolean'
        ];
    }

    public function toDto(): TournamentDTO
    {
        return new TournamentDTO(
            name: $this->get('name'),
//            type: TournamentType::tryFrom($this->get('type')),
            type: TournamentType::POINTS,
            is_home_away: $this->boolean('is_home_away')
        );
    }
}
