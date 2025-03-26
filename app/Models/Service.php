<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperService
 */
class Service extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'category_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function additions(): BelongsToMany
    {
        return $this->belongsToMany(Addition::class);
    }

    /**
     * @return BelongsToMany
     */
    public function workers(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'service_worker', 'service_id', 'worker_id')
            ->using(ServiceWorker::class)
            ->withPivot(['price', 'minutesNeeded']);
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters = []): Builder
    {
        $query->when($filters['worker_id'] ?? false, function($query, $workerId) {
            $excludedServicesIds = ServiceWorker::where('worker_id', $workerId)->pluck('service_id');

            return $query->whereNotIn('id', $excludedServicesIds)->get();
        });

        return $query;
    }
}
