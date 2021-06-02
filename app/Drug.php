<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{

    public function drugtype()
    {
        return $this->belongsTo('App\DrugType', 'drug_type_id');
    }

    public function pharmacydrugs()
    {
        return $this->hasMany('App\PharmacyDrug');
    }
}
