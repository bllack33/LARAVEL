<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public $timestamps = false;
    protected $table = 'cars';

    //relacion
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
