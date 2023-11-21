<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
    use HasFactory;
    protected $table = "entrepreneur";
    protected $guarded = ['id'];

    public function relasi_user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function relasi_lkp()
    {
        return $this->belongsTo(LKP::class, 'lkp_id', 'id');
    }

    public function relasi_kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function relasi_status_akun()
    {
        return $this->belongsTo(StatusAkun::class, 'status_akun_id', 'id');
    }
}
