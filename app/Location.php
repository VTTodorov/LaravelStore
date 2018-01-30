<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'locations';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function adverts()
    {
        return $this->hasMany('\App\Advert');
    }

    public function getRouteKeyName()
    {
        return "Name";
    }
}
