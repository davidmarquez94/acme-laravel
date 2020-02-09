<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name'
    ];

    //Relación con Vehículos
    public function vehicles(){
        return $this->hasMany('App\Vehicle');
    }
}
