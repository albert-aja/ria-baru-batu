<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\View\Gudang;

class Beranda extends Controller
{
    public function index()
    {
        $gudang_penambahan = Gudang::where('kondisi', 'Bertambah')->sum('kuantitas');
        $gudang_pengurangan = Gudang::where('kondisi', 'Berkurang')->sum('kuantitas');

        return view('admin.beranda.index', compact('gudang_penambahan', 'gudang_pengurangan'));
    }
}
