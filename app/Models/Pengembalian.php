<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $fillable = [
        'kode_peminjaman',  
    ];
}
