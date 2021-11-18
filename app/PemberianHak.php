<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemberianHak extends Model
{
    protected $table = 'pemberianpembaruanhaks';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
