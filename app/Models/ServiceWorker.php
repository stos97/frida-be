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
}
