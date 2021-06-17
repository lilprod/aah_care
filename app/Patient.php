<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Patient extends Model
{
    public function doctors()
    {
        //return $this->belongsToMany(Doctor::class);
        return $this->belongsToMany(Doctor::class, 'doctor_patient', 'patient_id','doctor_id' , 'status')->withTimeStamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1); 
    }

    public function appointments(){

        return $this->hasMany(Appointment::class);
        
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
