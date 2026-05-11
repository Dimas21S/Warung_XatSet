<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'outlet_id',
        'jenis_pengiriman',
        'alamat',
        'nama_penerima',
        'no_telepon',
        'waktu_pengiriman',
        'metode_pembayaran',
        'subtotal',
        'ongkir',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
