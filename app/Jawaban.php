<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    protected $fillable = ['isi_jawaban', 'user_id', 'pertanyaan_id'];

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
