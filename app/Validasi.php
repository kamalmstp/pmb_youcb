<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table ='pmb_validasi';
    protected $fillable = [
        'user_id','th_akademik_id','gelombang_id','file_bukti','status','admin_id'
    ];
}
