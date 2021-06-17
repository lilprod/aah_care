<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorClass extends Model
{
    public function user()
	{
	    return $this->belongsTo('App\User', 'doctor_user_id');
	}

	public function doctor()
	{
	    return $this->belongsTo('App\Doctor');
	}
}
