<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenghapusanHak extends Model
{
    protected $table = 'penghapusanhaks';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
