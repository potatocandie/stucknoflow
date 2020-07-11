<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';

    protected $fillable = ['tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'akun_github', 'user_img', 'user_id'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
