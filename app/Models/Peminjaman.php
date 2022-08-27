<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'books_loan';

    protected $fillable = [
        'book_id',
        'peminjam',
        'no_identitas',
        'tanggal_pinjam',
        'batas_pengembalian',
        'tanggal_kembali',
        'denda'
    ];
}
