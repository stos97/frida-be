<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperAddition
 */
class Addition extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::deleting(fn (Addition $addition) => $addition->services()->detach());
    }

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
    ];

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function scopeFilter(Builder $query, array $filters = []): Builder
    {
        $query->when($filters['service_id'] ?? false, function ($query, $serviceId) {
            $excludedAdditionsIds = Addition::whereHas('services', fn ($q) => $q->where('service_id', $serviceId))->pluck('id');

            return $query->whereNotIn('id', $excludedAdditionsIds)->get();
        });

        return $query;
    }
}
