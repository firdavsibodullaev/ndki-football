<?php

namespace App\Models;

use App\Enums\GamePlayerStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @var int $player_id
 * @var int $team_id
 * @var int $game_id
 * @var int $goals
 * @var GamePlayerStatus $status
 * @var string $played_from
 * @var string $played_until
 * @var int $replaced_by_id
 */
class GamePlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'team_id',
        'game_id',
        'goals',
        'status',
        'played_from',
        'played_until',
        'replaced_by_id'
    ];

    protected $casts = [
        'status' => GamePlayerStatus::class
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function replacedBy(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'replaced_by_id');
    }
}
