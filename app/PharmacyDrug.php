<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyDrug extends Model
{
    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }

    public function drug()
    {
        return $this->belongsTo('App\Drug');
    }
}
