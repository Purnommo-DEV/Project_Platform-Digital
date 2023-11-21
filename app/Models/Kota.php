<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = "kota";
    protected $guarded = ['id'];

    public function relasi_provinsi()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }
}
