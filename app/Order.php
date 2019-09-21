<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id', 'order_costumer_name', 'order_item', 'order_value', 'order_date',
    ];

    protected $table = 'orders';
    public $timestamps = false;
}
