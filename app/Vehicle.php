<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'plate',
        'color',
        'brand_id',
        'type',
        'owner_id',
        'driver_id'
    ];

    //Relación con conductor
    public function driver(){
        return $this->belongsTo('App\Driver', 'driver_id');
    }

    //Relación con propietario
    public function owner(){
        return $this->belongsTo('App\Owner', 'owner_id');
    }

    //Relación con marca
    public function brand(){
        return $this->belongsTo('App\Brand');
    }
}
