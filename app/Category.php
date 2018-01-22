<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    public function adverts()
    {
        return $this->hasMany('App\Advert');
    }

    public function getRouteKeyName()
    {
        return "name";
    }

}
