<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use SoftDeletes;

    protected $table = 'pictures';
    protected $fillable = array('user_id', 'image', 'is_deleted');
    protected $dates = ['deleted_at'];
    
    public $timestamps = false;

    public function adverts()
    {
        return $this->belongsTo('\App\Advert');
    }
}
