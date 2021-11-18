<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeralihanLelang extends Model
{
    protected $table = 'peralihanlelang';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
