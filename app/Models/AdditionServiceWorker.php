<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperAdditionServiceWorker
 */
class AdditionServiceWorker extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'service_worker_id',
        'addition_id',
        'price',
        'minutesNeeded',
    ];

    public function serviceWorker(): BelongsTo
    {
        return $this->belongsTo(ServiceWorker::class, 'service_worker_id');
    }

    public function addition(): BelongsTo
    {
        return $this->belongsTo(Addition::class);
    }
}
