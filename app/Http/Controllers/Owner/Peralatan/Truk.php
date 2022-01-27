<?php

namespace App\Http\Controllers\Owner\Peralatan;

use App\Http\Controllers\Controller;
use App\Models\Truk as ModelsTruk;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Truk extends Controller
{
    public function index()
    {
        return view('owner.peralatan.truk.index');
    }

    public function create()
    {
        $option_pegawai = $this->option_pegawai(null);
        return view('owner.peralatan.truk.create', compact('option_pegawai'));
    }

    public function store(Request $request)
    {
        $data = ModelsTruk::create([
            'supir' => $request->supir,
            'nama' => $request->nama,
            'no_plat' => $request->no_plat,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function show($id)
    {
        $data = ModelsTruk::findOrFail($id);
        return view('owner.peralatan.truk.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelsTruk::findOrFail($id);
        $option_pegawai = $this->option_pegawai($data->supir);
        return view('owner.peralatan.truk.edit', compact('data', 'option_pegawai'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelsTruk::findOrFail($id);
        $data->update([
            'supir' => $request->supir,
            'nama' => $request->nama,
            'no_plat' => $request->no_plat,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy(Request $request)
    {
        $data = ModelsTruk::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus truk.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsTruk::orderBy('nama');
        return DataTables::of($data)
            ->editColumn('supir', function ($data) {
                return ($data->supir ? $data->get_supir->name : 'Tidak Ada');
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Owner Peralatan Truk Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }

    public function option_pegawai($pegawai)
    {
        $datas = User::where('status', '1')->role(['Supir'])->get();

        $option = '<option></option>';

        foreach ($datas as $data) {
            $option .= '<option value="' . $data->id . '" ' . ($data->id == $pegawai ? 'selected' : '') . '>' . $data->name . '</option>';
        }

        return $option;
    }
}
