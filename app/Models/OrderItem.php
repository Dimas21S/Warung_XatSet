<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Menu;

class OrderItem extends Model
{
    //
    protected $fillable = [
        'order_id',
        'menu_id',
        'nama',
        'qty',
        'harga',
        'subtotal',
    ];

    public function menu()
    {
        return $this -> belongsTo(Menu::class, 'menu_id');
    }
}
