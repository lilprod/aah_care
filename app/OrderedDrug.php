<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedDrug extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }

    public function drug()
    {
        return $this->belongsTo('App\PharmacyDrug');
    }
}
