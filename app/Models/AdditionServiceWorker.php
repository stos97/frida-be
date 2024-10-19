<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionServiceWorker extends Model
{
    protected $fillable = [
        'service_worker_id',
        'addition_id',
        'price',
        'minutesNeeded'
    ];

    public function serviceWorker()
    {
        return $this->belongsTo(ServiceWorker::class, 'service_worker_id');
    }

    public function addition()
    {
        return $this->belongsTo(Addition::class);
    }
}
