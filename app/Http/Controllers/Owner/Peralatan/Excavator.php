<?php

namespace App\Http\Controllers\Owner\Peralatan;

use App\Http\Controllers\Controller;
use App\Models\Excavator as ModelsExcavator;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Excavator extends Controller
{
    public function index()
    {
        return view('owner.peralatan.excavator.index');
    }

    public function create()
    {
        $option_pegawai = $this->option_pegawai(null);
        return view('owner.peralatan.excavator.create', compact('option_pegawai'));
    }

    public function store(Request $request)
    {
        $data = ModelsExcavator::create([
            'operator' => $request->operator,
            'nama' => $request->nama,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function show($id)
    {
        $data = ModelsExcavator::findOrFail($id);
        return view('owner.peralatan.excavator.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelsExcavator::findOrFail($id);
        $option_pegawai = $this->option_pegawai($data->operator);
        return view('owner.peralatan.excavator.edit', compact('data', 'option_pegawai'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelsExcavator::findOrFail($id);
        $data->update([
            'operator' => $request->operator,
            'nama' => $request->nama,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy(Request $request)
    {
        $data = ModelsExcavator::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus excavator.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsExcavator::orderBy('nama');
        return DataTables::of($data)
            ->editColumn('operator', function ($data) {
                return ($data->get_operator ? $data->get_operator->name : 'Tidak Ada');
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Owner Peralatan Excavator Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }

    public function option_pegawai($pegawai)
    {
        $datas = User::where('status', '1')->role(['Operator Excavator'])->get();

        $option = '<option></option>';

        foreach ($datas as $data) {
            $option .= '<option value="' . $data->id . '" ' . ($data->id == $pegawai ? 'selected' : '') . '>' . $data->name . '</option>';
        }

        return $option;
    }
}
