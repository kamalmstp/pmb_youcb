<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    protected $table ='pmb_users';
    protected $fillable = [
        'name','email','nisn','telp','asal_sekolah','th_akademik_id','pmb_gelombang_id','biaya','password','level','user_id'
    ];

    public function thakademik()
    {
        return $this->belongsTo('App\ThAkademik', 'th_akademik_id');
    }
    public function gelombang()
    {
        return $this->belongsTo('App\Gelombang', 'pmb_gelombang_id');
    }
}
