<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'document_number',
        'address',
        'phone_number',
        'license_type',
        'city'
    ];

    public function vehicle(){
        return $this->hasOne('App\Vehicle', 'driver_id', 'id');
    }

}
