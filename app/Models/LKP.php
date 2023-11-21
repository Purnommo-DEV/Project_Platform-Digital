<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LKP extends Model
{
    use HasFactory;
    protected $table = "lkp";
    protected $guarded = ['id'];

    public function relasi_user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function relasi_kategori()
    {
        return $this->belongsTo(LKP_Kategori::class, 'kategori_id', 'id');
    }

    public function relasi_kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function relasi_entrepreneur()
    {
        return $this->belongsTo(Entrepreneur::class, 'lkp_id', 'id');
    }
}
