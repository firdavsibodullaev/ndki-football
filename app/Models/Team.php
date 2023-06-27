<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $name
 * @property boolean $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Player> $players
 */
class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active'
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
