<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'name', 'thumb', 'kategoris_id', 'price', 'deskripsi'
    ];

    public function Kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
