<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    //
    protected $table = 'pasien_profil';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
