<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LKP_GambarProduk extends Model
{
    use HasFactory;
    protected $table = "lkp_gambar_produk";
    protected $guarded = ['id'];

    public function relasi_lkp()
    {
        return $this->belongsTo(LKP::class, 'lkp_id', 'id');
    }
}
