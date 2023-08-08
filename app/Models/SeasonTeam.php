<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $season_id
 * @property int $team_id
 * @property int $points
 * @property int $goals_scored
 * @property int $goals_conceded
 * @property-read Season $season
 * @property-read Team $team
 */
class SeasonTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'team_id',
        'points',
        'goals_scored',
        'goals_conceded'
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
