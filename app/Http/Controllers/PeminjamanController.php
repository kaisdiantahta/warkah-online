<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogPeminjaman as Peminjaman;
use App\Models\Peminjam;
use App\Models\Book;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjam::query()
                ->with([
                    'pinjam' => function($log) {
                        $log->with('book');
                    }
                ])
                ->orderBy('created_at', 'desc')
                ->get();
        // dd($data);
        return view('peminjaman.index', compact('data'));
    }
    
    public function formPeminjaman()
    {
        return view('peminjaman.form-peminjaman');
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjam' => 'required',
            'no_identitas' => 'required',
            'books.*' => 'required'
        ]);

        try {
            // simpan identitas peminjam
            $peminjam = Peminjam::create([
                'nama_peminjam' => $request->peminjam,
                'no_identitas' => $request->no_identitas
            ]);

            // simpan data buku yang dipinjam
            foreach ($request->books as $key => $book) {
                Peminjaman::create([
                    'book_id' => $book,
                    'peminjam' => $peminjam->id,
                    'tanggal_pinjam' => now(),
                    'batas_pengembalian' => date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 7)) // 7 hari setelah peminjaman,
                ]);

                // update stok buku
                $buku = Book::where('id', $book)->first();
                $buku->update([
                    'stok' => $buku->stok - 1
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }

        return redirect()->route('peminjaman.index')->with('message', '<div class="alert alert-success my-3">Data peminjaman berhasil ditambahkan.</div>');
    }

    public function show($id)
    {
        $peminjaman = Peminjam::where('id', $id)
                    ->with([
                        'pinjam' => function($log) {
                            $log->with('book');
                        }
                    ])
                    ->first();
        return view('peminjaman.detail-peminjaman', compact('peminjaman'));
    }

    public function pengembalian($id)
    {
        $data = Peminjam::where('id', $id)
                    ->with([
                        'pinjam' => function($log) {
                            $log->with('book');
                        }
                    ])
                    ->first();
        return view('peminjaman.form-pengembalian', compact('data'));
    }

    public function update(Request $request, $peminjamId)
    {
        try {
            $peminjaman = Peminjaman::where('peminjam', $peminjamId)->get();
            $batas = Carbon::parse($peminjaman[0]->batas_pengembalian)->format('Ymd');

            // jika terlambat, hitung denda
            if (date('Ymd') > $batas) {
                $terlambat = date('Ymd') - $batas;

                foreach ($request->books ?? [] as $key => $book_id) {
                    $denda[$book_id] = 1000*$terlambat;
                }
            }

            foreach ($peminjaman as $key => $val) {
                Peminjaman::where('id', $val->id)
                        ->update([
                            'tanggal_kembali' => in_array($val->book_id, $request->books ?? []) ? now() : null,
                            'denda' => $denda[$val->book_id] ?? 0
                        ]);

                // update stok
                $book = Book::where('id', $val->book_id)->first();
                $book->update([
                    'stok' => $book->stok + 1
                ]);
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');  
        }

        return redirect()->route('peminjaman.index')->with('message', '<div class="alert alert-success my-3">Buku telah disimpan kembali.</div>');
    }

    public function delete($id)
    {
        Book::where('id', $id)->delete();
        return redirect()->back()->with('message', '<div class="alert alert-success my-3">Data buku berhasil dihapus.</div>');
    }
}
