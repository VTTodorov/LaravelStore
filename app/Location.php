<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'locations';

    public function adverts()
    {
        return $this->hasMany('\App\Advert');
    }

    public function getRouteKeyName()
    {
        return "Name";
    }
}
