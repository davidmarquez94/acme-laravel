<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name'
    ];

    public function vehicles(){
        return $this->hasMany('App\Vehicle');
    }
}
