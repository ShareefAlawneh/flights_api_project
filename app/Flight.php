<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\Customer');

    }

   

    public function passengers()
    {
    	return $this->belongsToMany('App\Customer','reservation');
    }

 

}
