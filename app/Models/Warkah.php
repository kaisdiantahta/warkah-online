<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warkah extends Model
{
    use HasFactory;
       protected $fillable = [
        'nomor_akta',
        'nama_pihak1',
        'nama_pihak2',
        'rincian',
        'alamat',
        'nominal_transaksi',
        'file',
        'nama_file',
    ];

}
