<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    // The table
    protected $table = 'adverts';
    protected $fillable = array('user_id', 'category_id','location_id', 'title', 'body', 'image','price', 'expires_on');

    // Get all active adds
    public static function active($pagination = false)
    {
        if ($pagination)
            return static::where('isActive', 1)->whereDate('expires_on', '>', date('Y-m-d'))->orderBy('created_at', 'desc')->paginate(10);

        return static::where('isActive', 1)->whereDate('expires_on', '>', date('Y-m-d'))->orderBy('created_at', 'desc')->limit(10)->get();
    }

    // Get all by category ID
    public static function byCategory($id)
    {
        return static::where('isActive', 1)->whereDate('expires_on', '>', date('Y-m-d'))->where('category_id', $id)->paginate(10);
    }

    // Get all by location
    public static function byLocation($id)
    {
        return static::where('isActive', 1)->whereDate('expires_on', '>', date('Y-m-d'))->where('location_id', $id)->paginate(10);
    }

    // Get all by category AND location
    public static function byCategoryLocation($categoty_id, $location_id)
    {
        return static::where('isActive', 1)->whereDate('expires_on', '>', date('Y-m-d'))->where('category_id', $categoty_id)->where('location_id', $location_id)->paginate(10);
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
