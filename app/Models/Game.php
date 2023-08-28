<?php

namespace App\Models;

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
 * @property boolean $is_played
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
        'is_played'
    ];

    protected $casts = [
        'game_at' => 'datetime',
        'is_played' => 'boolean'
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

        return Attribute::get(fn() => "$home v $away");
    }
}
