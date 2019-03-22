<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //se asigna la tabla a una variable
    protected $table = 'videos';

    //Relacion uno a muchos hasMany
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'desc'); //relaciona todos los comentarios que esten relacionados con el video
    }

    //relacion de Muchos a uno, saca el usuario completo que ha creado el video, belongsTo
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id'); //carga todo el usuario que se identifique con ese campo
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'id'); //carga todo el usuario que se identifique con ese campo
    }
}
