<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peralihanjualbeli extends Model
{
    protected $table = 'peralihanjualbeli';
    protected $guarded = ['id'];
    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
