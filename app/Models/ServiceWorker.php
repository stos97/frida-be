<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperServiceWorker
 */
class ServiceWorker extends Pivot
{
    protected $table = 'service_worker';

    /**
     * @var string[]
     */
    protected $fillable = [
        'price',
        'minutesNeeded',
    ];

    public function additions(): HasMany
    {
        return $this->hasMany(AdditionServiceWorker::class, 'service_worker_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}
