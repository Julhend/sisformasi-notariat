<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeralihanWaris extends Model
{
    protected $table = 'peralihanwaris';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
