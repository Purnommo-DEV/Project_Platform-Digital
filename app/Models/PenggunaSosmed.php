<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaSosmed extends Model
{
    use HasFactory;
    protected $table = "pengguna_sosmed";
    protected $guarded = ['id'];

    public function relasi_user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
