<?php

namespace App\Http\Requests\Game;

use App\DTOs\Game\GameDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
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
        $season = $this->route('season');
        return [
            'game' => 'required|array',
            'game.*' => 'required|array',
            'game.*.home' => [
                'required',
                'integer',
                Rule::exists('season_teams', 'id')->where('season_id', $season->id)
            ],
            'game.*.date' => 'required|string|date|date_format:Y-m-d',
            'game.*.away' => [
                'required',
                'integer',
                Rule::exists('season_teams', 'id')->where('season_id', $season->id)
            ],
            'game.*.round' => 'required|integer',
        ];
    }

    public function toDto(): GameDTO
    {
        $payload = $this->validated();
        $payload['started_at'] = Carbon::createFromFormat('Y-m-d', $payload['started_at'])->startOfDay();
        $payload['finished_at'] = Carbon::createFromFormat('Y-m-d', $payload['finished_at'])->endOfDay();

        return new GameDTO(...$payload);
    }
}
