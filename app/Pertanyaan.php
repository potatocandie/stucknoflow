<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $fillable = ['judul', 'isi'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Tag', 'pertanyaan_tag', 'pertanyaan_id', 'tag_id');
    }

    public function jawaban()
    {
        return $this->hasMany('App\Jawaban');
    }
}
