<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property int $season_id
 * @property int $team_1
 * @property int $team_2
 * @property Carbon $game_at
 * @property int $team_1_goals
 * @property int $team_2_goals
 * @property-read Season $season
 * @property-read Team $team1
 * @property-read Team $team2
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'team_1',
        'team_2',
        'game_at',
        'team_1_goals',
        'team_2_goals'
    ];

    protected $casts = [
        'game_at' => 'datetime'
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function team1(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_1');
    }

    public function team2(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_2');
    }
}
