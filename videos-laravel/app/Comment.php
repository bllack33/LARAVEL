<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'Comments';
	//relacion de muchos a uno
    public function user(){
    	return $this->belongsTo('App\User','user_id'); //carga todo el usuario que se identifique con ese campo

    }

    public function video(){
    	return $this->belongsTo('App\Video','video_id'); 
    }



}
