<?php

namespace App\Http\Requests\Season;

use App\DTOs\Season\SeasonDTO;
use App\Models\Season;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

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
            'tournament_id' => ['required', 'int', Rule::exists('tournaments', 'id')]
        ];
    }

    public function toDto(): SeasonDTO
    {
        return new SeasonDTO(...$this->validated());
    }
}
