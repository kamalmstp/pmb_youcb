<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenPersyaratan extends Model
{
    protected $table ='pmb_formulir_syarat';
    protected $fillable = [
        'pmb_formulir_id','nama_berkas','berkas','valid','user_id'
    ];
}
