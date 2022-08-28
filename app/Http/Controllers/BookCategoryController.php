<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;

class BookCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = BookCategory::latest()->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ]);

        try {
            BookCategory::create([
                'name' => $request->category,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');
        }

        return redirect()->route('category.index')->with('message', '<div class="alert alert-success my-3">Kategori baru berhasil ditambahkan.</div>');
    }

    public function edit($id)
    {
        $category = BookCategory::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required'
        ]);

        try {
            BookCategory::where('id', $id)->update([
                'name' => $request->category,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">'.$e->getMessage().'</div>');  
        }

        return redirect()->route('category.index')->with('message', '<div class="alert alert-success my-3">Kategori berhasil diubah.</div>');
    }

    public function delete($id)
    {
        $category = BookCategory::where('id', $id)->withCount('books')->first();
        if ($category->books_count > 0) {
            return redirect()->back()->with('message', '<div class="alert alert-danger my-3">Kategori tidak bisa dihapus, karena terkait dengan berbagai data buku.</div>');
        } 

        $category->delete();
        return redirect()->back()->with('message', '<div class="alert alert-success my-3">Kategori berhasil dihapus.</div>');
    }

    public function jsonAll(Request $request)
    {
        if ($request->has('q')) {
            $data = BookCategory::where('name', 'like', '%'.$request->q.'%')->limit(10)->get();
        } else {
            $data = BookCategory::limit(10)->get();
        }

        return response()->json($data);
    }
}
