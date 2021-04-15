<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    protected $table ='pmb_gelombang';
    protected $fillable = [
        'mst_th_akademik_id', 'gelombang', 'biaya','tgl_mulai','tgl_selesai','ketua_panitia','aktif','user_id'
    ];

    protected $dates = ['tgl_mulai', 'tgl_selesai'];

    public function thakademik()
    {
        return $this->belongsTo('App\ThAkademik','mst_th_akademik_id');
    }
}
