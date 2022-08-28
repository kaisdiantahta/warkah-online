<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::get();

        return view('book.index', compact('books'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required'
        ]);

        try {
            Book::create([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'isbn' => $request->isbn,
                'stok' => $request->stok,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }

        return redirect()->route('book.index')->with('message', '<div class="alert alert-success my-3">Data buku berhasil ditambahkan.</div>');
    }

    public function show($id)
    {
        $book = Book::find($id);
        return view('book.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required'
        ]);

        try {
            Book::where('id', $id)->update([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'isbn' => $request->isbn,
                'stok' => $request->stok
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');  
        }

        return redirect()->route('book.index')->with('message', '<div class="alert alert-success my-3">Data buku berhasil diubah.</div>');
    }

    public function delete($id)
    {
        Book::where('id', $id)->delete();
        return redirect()->back()->with('message', '<div class="alert alert-success my-3">Data buku berhasil dihapus.</div>');
    }

    public function jsonAll(Request $request)
    {
        if ($request->has('q')) {
            $data = Book::where('stok', '>', 0)->where('judul', 'like', '%'.$request->q.'%')->limit(10)->get();
        } else {
            $data = Book::where('stok', '>', 0)->limit(10)->get();
        }

        return response()->json($data);
    }
}
