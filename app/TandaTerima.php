<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TandaTerima extends Model
{
    protected $table = 'tanda_terima';
    protected $guarded = ['id'];

    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
