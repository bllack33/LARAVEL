<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserV extends Model
{
    protected $table = 'users';

    public function videos()
    {
        return $this->belongsTo('App\Video', 'user_id');
    }
}
