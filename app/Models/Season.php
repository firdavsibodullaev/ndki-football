<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $name
 * @property int $tournament_id
 * @property Carbon $started_at
 * @property Carbon $finished_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read string $dates
 * @property-read bool $is_current
 * @property-read Collection $seasonTeams
 * @property-read Tournament $tournament
 */
class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tournament_id',
        'started_at',
        'finished_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function seasonTeams(): HasMany
    {
        return $this->hasMany(SeasonTeam::class);
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function dates(): Attribute
    {
        $from = $this->started_at->format('d.m.Y');
        $to = $this->finished_at->format('d.m.Y');
        return Attribute::get(fn() => "$from - $to");
    }

    public function isCurrent(): Attribute
    {
        return Attribute::get(fn() => now()->between($this->started_at, $this->finished_at));
    }

    public function years(): Attribute
    {
        $from = $this->started_at->format('Y');
        $to = $this->finished_at->format('Y');
        return Attribute::get(fn() => "$from - $to");
    }
}
