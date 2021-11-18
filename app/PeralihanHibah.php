<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeralihanHibah extends Model
{
    protected $table = 'peralihanhibah';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
