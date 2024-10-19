<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ServiceWorker extends Pivot
{
    protected $table = 'service_worker';

    protected $fillable = [
        'price',
        'minutesNeeded',
    ];

    public function additions()
    {
        return $this->hasMany(AdditionServiceWorker::class, 'service_worker_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
