<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $table = 'pictures';
    protected $fillable = array('user_id', 'image');
    public $timestamps = false;

    public function adverts()
    {
        return $this->belongsTo('\App\Advert');
    }
}
