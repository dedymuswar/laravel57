<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['users_id', 'komentar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
