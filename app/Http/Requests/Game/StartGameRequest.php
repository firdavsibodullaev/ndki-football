<?php

namespace App\Http\Requests\Game;

use App\DTOs\Game\Start\ParticipantDTO;
use App\DTOs\Game\Start\PlayerDTO;
use App\DTOs\Game\Start\StartGameDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StartGameRequest extends FormRequest
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
            'game' => ['required', 'array', 'size:2'],
            'game.home' => ['required', 'array', 'size:2'],
            'game.home.team_id' => ['required', 'int', Rule::exists('season_teams', 'id')],
            'game.home.players' => ['required', 'array'],
            'game.home.players.*' => ['required', 'array'],
            'game.home.players.*.player_id' => [
                'required',
                'int',
                Rule::exists('players', 'id')->where('is_active', true)
            ],
            'game.home.players.*.on_start' => ['boolean'],
            'game.away' => ['required', 'array', 'size:2'],
            'game.away.team_id' => ['required', 'int', Rule::exists('season_teams', 'id')],
            'game.away.players' => ['required', 'array'],
            'game.away.players.*' => ['required', 'array'],
            'game.away.players.*.player_id' => [
                'required',
                'int',
                Rule::exists('players', 'id')->where('is_active', true)
            ],
            'game.away.players.*.on_start' => ['boolean'],
        ];
    }

    public function toDto(): StartGameDTO
    {
        $payload = $this->collect('game')
            ->map(
                callback: fn(array $participant, string $key) => new ParticipantDTO(
                    team_id: $participant['team_id'],
                    players: collect($participant['players'])->map(
                        callback: fn(array $player) => new PlayerDTO(
                            player_id: $player['player_id'],
                            on_start: (bool)($player['on_start'] ?? false)
                        )
                    )
                )
            );

        return new StartGameDTO(
            home: $payload['home'],
            away: $payload['away']
        );
    }
}
