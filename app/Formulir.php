<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    protected $table ='pmb_formulir';
    protected $fillable = [
        'nomor','th_akademik_id','pmb_gelombang_id','kode_agent','prodi_id','kelas_id', 'nik','nisn','nama','jk_id','tempat_lahir','tanggal_lahir','agama','gol_darah','tinggi_badan','berat_badan','desa','kecamatan','kota_id','provinsi','alamat','hp','email','nilai_terakhir','sd','smp','sma','nik_ayah','nama_ayah','pekerjaan_ayah','pendidikan_ayah','penghasilan_ayah','no_ayah','alamat_ayah','nik_ibu','nama_ibu','pekerjaan_ibu','pendidikan_ibu','penghasilan_ibu','no_ibu','alamat_ibu','nik_wali','nama_wali','pekerjaan_wali','pendidikan_wali','penghasilan_wali','no_wali','alamat_wali','user_id','tanggal','foto'
    ];

    public function thakademik()
    {
        return $this->belongsTo('App\ThAkademik', 'th_akademik_id');
    }

    public function gelombang()
    {
        return $this->belongsTo('App\Gelombang', 'pmb_gelombang_id');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Prodi', 'prodi_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas_id');
    }

    public function jeniskelamin()
    {
        return $this->belongsTo('App\JenisKelamin', 'jk_id');
    }

    public function kota()
    {
        return $this->belongsTo('App\Kota', 'kota_id');
    }

    public function syarat()
    {
        return $this->hasMany('App\DokumenPersyaratan', 'pmb_formulir_id');
    }
    


}
