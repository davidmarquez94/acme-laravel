<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'owners';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'document_number',
        'address',
        'phone_number',
        'city'
    ];

    //Relación con Vehículo
    public function vehicles(){
        return $this->hasOne('App\Vehicles', 'owner_id', 'id');
    }
}
