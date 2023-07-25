<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $last_name
 * @property string $first_name
 * @property string $patronymic
 * @property int $number
 * @property boolean $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'patronymic',
        'number',
        'is_active'
    ];
}
