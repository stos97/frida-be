<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalServiceWorker extends Model
{
    protected $fillable = [
        'service_worker_id',
        'additional_service_id',
        'price',
        'minutesNeeded'
    ];

    public function serviceWorker()
    {
        return $this->belongsTo(ServiceWorker::class, 'service_worker_id');
    }

    public function addtinaslService()
    {
        return $this->belongsTo(AdditionalService::class);
    }
}
