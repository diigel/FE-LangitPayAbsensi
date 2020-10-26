<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lp_absensi extends Model
{
    use HasFactory;

    protected $table = 'lp_absensi';

    public function user()
    {
        return $this->hasOne('App\Models\lp_user', 'id', 'user_id');
    }
}
