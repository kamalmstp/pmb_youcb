<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'pmb_agent';
    protected $fillable = [
        'name', 'nik', 'telepon', 'email', 'tanggal_lahir', 'tempat_lahir', 'pekerjaan', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'alamat', 'nama_pj', 'nomor_pj', 'kode_ucb', 'nomor_daftar', 'kode_agent', 'surat_keterangan', 'jenis_kelamin', 'agama', 'status_perkawinan', 'jabatan', 'nama_lembaga', 'telepon_kantor', 'alamat_kantor', 'file', 'valid'
    ];
}
