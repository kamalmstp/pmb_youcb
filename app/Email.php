<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'pmb_email';
    protected $fillable = [
        'kepada', 'subject', 'isi', 'lampiran', 'status'
    ];
}
