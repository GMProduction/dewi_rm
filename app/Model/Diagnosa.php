<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    //
    protected $table = 'diagnosa';

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'user_id');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'user_id');
    }

    public function resep()
    {
        return $this->hasMany(Resep::class, 'diagnosa_id', 'id');
    }
}
