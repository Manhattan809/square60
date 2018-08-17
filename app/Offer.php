<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    public function details()
    {
        return $this->hasMany('App\OfferDetail');
    }
}
