<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table ='pmb_info';
    protected $fillable = [
        'judul','isi','publish','user_id'
    ];
}
