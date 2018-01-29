<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    // The table
    protected $table = 'adverts';
    protected $fillable = array('user_id', 'category_id','location_id', 'title', 'body', 'image','price', 'expires_on');
    // Get all active adds
    public static function active()
    {
        return static::where('isActive', 1)->get();
    }


    public function getRouteKeyName()
    {
        return "id";
    }

    // Create Relationships

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function location()
    {
        return $this->belongsTo('Location');
    }
}
