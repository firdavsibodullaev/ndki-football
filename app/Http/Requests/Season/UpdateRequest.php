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
            'started_at' => [
                'required',
                'date',
                'date_format:Y-m-d'
            ],
            'finished_at' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:started_at'
            ],
            'tournament_id' => ['required', 'int', Rule::exists('tournaments', 'id')]
        ];
    }

    public function toDto(): SeasonDTO
    {
        $payload = $this->validated();
        $payload['started_at'] = Carbon::createFromFormat('Y-m-d', $payload['started_at'])->startOfDay();
        $payload['finished_at'] = Carbon::createFromFormat('Y-m-d', $payload['finished_at'])->endOfDay();

        return new SeasonDTO(...$payload);
    }
}
