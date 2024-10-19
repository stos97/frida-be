<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function additions()
    {
        return $this->belongsToMany(Addition::class);
    }

    public function workers()
    {
        return $this
            ->belongsToMany(User::class, 'service_worker', 'service_id', 'worker_id')
            ->using(ServiceWorker::class)
            ->withPivot(['price', 'minutesNeeded']);
    }
}
