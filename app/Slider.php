<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table ='pmb_slider';
    protected $fillable = [
        'judul','gambar','aktif','user_id'
    ];
}
