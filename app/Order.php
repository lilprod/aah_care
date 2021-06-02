<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }

    public function ordereddrugs()
    {
        return $this->hasMany('App\OrderedDrug');
    }
}
