<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderan extends Model
{
    protected $fillable = [
        'id', 'order', 'order_total', 'order_date'
    ];

    public $timestamps = false;

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'orderan_id', 'order');
    }
}
