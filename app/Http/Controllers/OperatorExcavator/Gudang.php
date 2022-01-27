<?php

namespace App\Http\Controllers\OperatorExcavator;

use App\Http\Controllers\Controller;
use App\Models\View\Gudang as ViewGudang;
use Yajra\DataTables\DataTables;

class Gudang extends Controller
{
    public function index()
    {
        return view('admin.gudang.index');
    }

    public function show($id)
    {
        $data = ViewGudang::findOrFail($id);
        return view('admin.gudang.show', compact('data'));
    }

    public function dt()
    {
        $data = ViewGudang::orderBy('tgl');
        return DataTables::of($data)
            ->editColumn('kuantitas', function ($data) {
                return $data->kuantitas . ' Truk';
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Admin Gudang Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }
}
