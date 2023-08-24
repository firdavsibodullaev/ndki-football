<?php

namespace App\Http\Requests\Game;

use App\Collections\GamesCollection;
use App\Collections\RoundCollection;
use App\DTOs\Game\GameDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\callback;

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
            'game.*' => 'array',
            'game.*.*' => 'required|array',
            'game.*.*.home' => [
                'required',
                'integer',
                Rule::exists('season_teams', 'id')->where('season_id', $season->id)
            ],
            'game.*.*.date' => 'required|string|date|date_format:Y-m-d\TH:i',
            'game.*.*.away' => [
                'required',
                'integer',
                Rule::exists('season_teams', 'id')->where('season_id', $season->id)
            ],
            'game.*.*.round' => 'required|integer',
        ];
    }

    public function toDto(): GamesCollection
    {
        return new GamesCollection(
            items: array_map(
                callback: fn(array $round) => new RoundCollection(
                    items: array_map(
                        callback: fn(array $game) => new GameDTO(
                            season_id: $this->route('season')->id,
                            away_id: $game['away'],
                            home_id: $game['home'],
                            game_at: Carbon::createFromFormat('Y-m-d\TH:i', $game['date']),
                            round: $game['round'],
                        ),
                        array: $round
                    )
                ),
                array: $this->validated('game')
            )
        );
    }
}
