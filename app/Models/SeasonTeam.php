<?php

namespace App\Models;

use App\Enums\CacheKeys;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

/**
 * @property-read int $id
 * @property int $season_id
 * @property int $team_id
 * @property int $points
 * @property int $goals_scored
 * @property int $goals_conceded
 * @property int $rounds
 * @property int $victory
 * @property int $defeat
 * @property int $draw
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
        'goals_conceded',
        'rounds',
        'victory',
        'defeat',
        'draw',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function players(): HasMany
    {
        $cache_key = CacheKeys::GAME_ID->key(['start' => LARAVEL_START, 'user_id' => auth()->id()]);
        $game_id = Cache::get($cache_key);

        return $this->hasMany(GamePlayer::class, 'team_id')
            ->when(
                value: $game_id,
                callback: fn(Builder $builder) => $builder->where('game_id', '=', $game_id)
            );
    }
}
