<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }
}
