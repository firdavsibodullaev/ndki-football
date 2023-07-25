<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $name
 * @property Carbon $started_at
 * @property Carbon $finished_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'started_at',
        'finished_at'
    ];

    protected $casts = [
        'started_at' => 'date',
        'finished_at' => 'date',
    ];
}
