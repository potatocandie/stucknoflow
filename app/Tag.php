<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    protected $fillable = ['isi_tag'];

    public function pertanyaan()
    {
        return $this->belongsToMany('App\Pertanyaan', 'pertanyaan_tag', 'tag_id', 'pertanyaan_id');
    }
}
