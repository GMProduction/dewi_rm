<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Spesialis extends Model
{
    //
    protected $table = 'spesialis';


    public function dokter()
    {
        return $this->hasMany(Dokter::class);
    }
}
