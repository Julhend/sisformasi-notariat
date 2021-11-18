<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formatsurat extends Model
{
    protected $table = 'formatsurat';
    protected $fillable = ['nama_surat','file','keterangan'];
}
