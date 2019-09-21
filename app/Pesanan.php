<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{

    public function orderan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
