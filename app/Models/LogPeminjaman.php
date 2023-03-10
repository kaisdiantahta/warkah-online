<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogPeminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'log_peminjaman';

    protected $fillable = [
        'book_id',
        'peminjam',
        'no_identitas',
        'tanggal_pinjam',
        'batas_pengembalian',
        'tanggal_kembali',
        'denda'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
