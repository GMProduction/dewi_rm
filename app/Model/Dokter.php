<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    //
    protected $table = 'dokter_profil';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class, 'spesialis_id');
    }
}
