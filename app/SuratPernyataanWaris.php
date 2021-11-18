<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratPernyataanWaris extends Model
{
    protected $table = 'suratwaris';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
