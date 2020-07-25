<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    //
    protected $table = 'resep';

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
