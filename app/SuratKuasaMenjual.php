<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKuasaMenjual extends Model
{
    protected $table = 'suratkuasamenjual';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
