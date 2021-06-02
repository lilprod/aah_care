<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Pharmacy extends Authenticatable
{
    use Notifiable;

    protected $guard = 'pharmacy';

    protected $fillable = [
        'name','phone_number', 'email', 'username', 'password', 'address','city','region','country','logo', 'slogan','director_name','proof_file','creation_date','open_time','end_time','profile_picture','email_verfied_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    public function suppliers()
    {
        return $this->hasMany('App\Supplier');
    }

    public function drugs()
    {
        return $this->hasMany('App\PharmacyDrug');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}

