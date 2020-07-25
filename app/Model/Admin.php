<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admin_profil';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
