<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::get();

        return view('peminjaman.index', compact('data'));
    }
}
