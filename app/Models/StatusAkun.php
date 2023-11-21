<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAkun extends Model
{
    use HasFactory;

    protected $table = "status_akun";
    protected $guarded = ['id'];
}
