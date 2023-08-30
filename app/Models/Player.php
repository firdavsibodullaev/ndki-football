<?php

namespace App\Models;

use App\Enums\MediaCollection;
use App\Filters\Player\TeamFilter;
use App\Traits\InteractsWithFilters;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property-read int $id
 * @property string $last_name
 * @property string $first_name
 * @property string $patronymic
 * @property int $number
 * @property boolean $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read string $full_name
 * @property-read string $name_initials
 * @property-read Media|null $avatar
 */
class Player extends Model implements HasMedia
{
    use HasFactory, InteractsWithFilters, InteractsWithMedia;

    protected $fillable = [
        'last_name',
        'first_name',
        'patronymic',
        'team_id',
        'number',
        'is_active'
    ];

    protected array $filters = [
        TeamFilter::class => 'team_id'
    ];

    public function fullName(): Attribute
    {
        return Attribute::get(
            fn() => "$this->last_name $this->first_name $this->patronymic"
        );
    }

    public function nameInitials(): Attribute
    {
        $first_name_initials = get_initials($this->first_name);
        $patronymic_initials = get_initials($this->patronymic);

        return Attribute::get(fn() => "$this->last_name $first_name_initials.$patronymic_initials.");
    }

    public function avatar(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', '=', MediaCollection::PLAYER_AVATAR->value);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
