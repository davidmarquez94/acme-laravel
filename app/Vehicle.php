<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'plate',
        'color',
        'brand',
        'type',
        'owner_id',
        'driver_id'
    ];

    public function driver(){
        return $this->belongsTo('App\Driver', 'driver_id');
    }

    public function owner(){
        return $this->belongsTo('App\Owner', 'owner_id');
    }
}
