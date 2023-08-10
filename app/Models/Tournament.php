<?php

namespace App\Models;

use App\Enums\TournamentType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $name
 * @property TournamentType $type
 * @property boolean $is_home_away
 * @property-read Collection $seasons
 */
class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'is_home_away'
    ];

    protected $casts = [
        'is_home_away' => 'boolean',
        'type' => TournamentType::class
    ];

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }
}
