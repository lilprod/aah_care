<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Favourite;
use Illuminate\Support\Facades\Auth;
use AgilePixels\Rateable\Traits\HasRating;

class Doctor extends Model
{
    use HasRating;

    protected $fillable = [
        'name', 'fistname','email','phone_number','username', 'address', 'profile_picture','gender', 'speciality_id',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1); 
    }

    public function scopeMatricule($query)
    {
        return $query->where('matricule', '!=', ''); 
    }

    public function scopeSpeciality($query)
    {
        return $query->where('speciality_id', '!=', ''); 
    }

    //Then call the scopes as given below
 
    //$users = User::active()->get();

    public function scopeFilter($query, $params)
    {

    	if ( isset($params['name']) && trim($params['name'] !== '') ) {
            $query->where('name', 'LIKE', trim($params['name']) . '%');
        }

        if ( isset($params['query']) && trim(!empty($params['query']))) {
            $query->where('name', 'LIKE', trim($params['query']) . '%')
                ->orWhere('firstname', 'LIKE', trim($params['query']) . '%');
        }

        if ( isset($params['exercice_place']) && trim($params['exercice_place'] !== '') ) {
            $query->where('exercice_place', 'LIKE', trim($params['exercice_place']) . '%');
        }

        if ( isset($params['gender']) && trim($params['gender'] !== '') ) {

            $query->where('gender', '=', trim($params['gender']));

        }

        if ( isset($params['speciality_id']) && trim($params['speciality_id']) !== '' )
        {
            $query->where('speciality_id', '=', trim($params['speciality_id']));
        }
        //return $query;
    }

    public function signature()
    {
        return $this->hasOne('App\Signature');
    }

    public function populary()
    {
        return $this->hasOne('App\DoctorClass');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Speciality');
    }

    public function favorited()
    {
        return (bool) Favourite::where('user_id', Auth::id())
                            ->where('doctor_id', $this->id)
                            ->first();
    }

    public function patients()
    {
        //return $this->belongsToMany(Patient::class);
        return $this->belongsToMany(Patient::class, 'doctor_patient', 'doctor_id', 'patient_id', 'status')->withTimeStamps();
    }

    public function services(){

        return $this->hasMany(DoctorService::class);
        
    }

    public function awards(){

        return $this->hasMany(Award::class);
        
    }

    public function experiences(){

        return $this->hasMany(Experience::class);
        
    }

    public function educations(){

        return $this->hasMany(Education::class);
        
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
