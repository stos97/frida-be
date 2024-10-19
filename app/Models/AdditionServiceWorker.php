<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdditionServiceWorker extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'service_worker_id',
        'addition_id',
        'price',
        'minutesNeeded'
    ];

    /**
     * @return BelongsTo
     */
    public function serviceWorker(): BelongsTo
    {
        return $this->belongsTo(ServiceWorker::class, 'service_worker_id');
    }

    /**
     * @return BelongsTo
     */
    public function addition(): BelongsTo
    {
        return $this->belongsTo(Addition::class);
    }
}
