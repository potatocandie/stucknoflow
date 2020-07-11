<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'like';

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan', 'pertanyaan_id');
    }
}
