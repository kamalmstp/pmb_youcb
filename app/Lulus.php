<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lulus extends Model
{
    protected $table ='pmb_lulus';
    protected $fillable = [
        'pmb_formulir_id','prodi_id','kelas_id','user_id'
    ];

    public function thakademik()
    {
        return $this->belongsTo('App\ThAkademik', 'th_akademik_id');
    }

    public function gelombang()
    {
        return $this->belongsTo('App\Gelombang', 'pmb_gelombang_id');
    }

    public function formulir()
    {
        return $this->belongsTo('App\Formulir', 'pmb_formulir_id');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Prodi', 'prodi_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\kelas', 'kelas_id');
    }
}
