<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'kategori_id',
        'harga',
        'deskripsi',
        'gambar',
        'stok',
        'is_available',
        'outlet_id',
        'discount_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlets::class);
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }
}
