<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
    'nama_aplikasi',
    'logo',
    'no_cs',
    'alamat',
    'facebook',
    'instagram',
    'twitter',
    'whatsapp',
    'outlet_id',
];
}
