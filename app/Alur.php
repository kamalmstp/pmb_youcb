<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alur extends Model
{
    protected $table ='pmb_alur_pendaftaran';
    protected $fillable = [
        'gambar','aktif','user_id'
    ];
}
