<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\View\Gudang as ViewGudang;
use Carbon\Carbon;
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
        $data = ViewGudang::orderBy('tgl', 'desc');
        return DataTables::of($data)
            ->editColumn('kuantitas', function ($data) {
                return $data->kuantitas . ' Truk';
            })
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y');
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Admin Gudang Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }
}
