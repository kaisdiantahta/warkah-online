<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'judul',
        'book_category_id',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'stok'
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(LogPeminjaman::class, 'book_id');
    }
}
