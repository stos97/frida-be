<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
