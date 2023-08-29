<?php

namespace App\Models;

use App\Enums\Game as GameEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property int $season_id
 * @property int $home_id
 * @property int $away_id
 * @property Carbon $game_at
 * @property int $round
 * @property int $home_goals
 * @property int $away_goals
 * @property GameEnum $status
 * @property-read string $home_away
 * @property-read Season $season
 * @property-read Team $home
 * @property-read Team $away
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'home_id',
        'away_id',
        'game_at',
        'round',
        'home_goals',
        'away_goals',
        'status'
    ];

    protected $casts = [
        'game_at' => 'datetime',
        'is_played' => 'boolean',
        'status' => GameEnum::class
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function home(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_id');
    }

    public function away(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_id');
    }

    public function homeAway(): Attribute
    {
        $this->loadMissing(['home', 'away']);
        $home = $this->home->name;
        $away = $this->away->name;
        $scores = match ($this->status) {
            GameEnum::PENDING => 'v',
            GameEnum::PLAYING,
            GameEnum::PLAYED => "$this->home_goals : $this->away_goals"
        };

        return Attribute::get(fn() => "$home $scores $away");
    }
}
