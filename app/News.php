<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title', 'body'];

    //get all news
    public static function active()
    {
        return static::where('isActive', 1)->paginate(20);
    }

    public function getRouteKeyName()
    {
        return "id";
    }
}
