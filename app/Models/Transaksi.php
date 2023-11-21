<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $table = "transaksi";
    protected $guarded = ['id'];

    public function relasi_user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function relasi_status_transaksi()
    {
        return $this->belongsTo(StatusTransaksi::class, 'status_id', 'id');
    }
}
