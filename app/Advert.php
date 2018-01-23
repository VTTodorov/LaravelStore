<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    // The table
    protected $table = 'adverts';
    protected $fillable = array('user_id', 'category_id','location_id', 'title', 'body', 'image','price', 'expires_on');
    // Get all active addslashes

    public static function active()
    {
        return static::where('isActive', 1)->get();
    }

    // Get all user addslashes

    public static function byUser($user_id)
    {
        return static::where('user_id', $user_id)->get();
    }

    // Create Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function location()
    {
        return $this->belongsTo('Location');
    }
}
