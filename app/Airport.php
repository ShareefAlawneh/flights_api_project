<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    public function outFlight()
    {
    	return $this->hasMany('App\Flight','takeoff_airport');
    }

     public function inFlight()
    {
    	return $this->hasMany('App\Flight','arrival_airport');
    }
}
