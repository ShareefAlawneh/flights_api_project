<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function flight()
    {
    	return $this->hasMany('App\Flight');
    }
}
