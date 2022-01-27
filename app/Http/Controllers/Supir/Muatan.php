<?php

namespace App\Http\Controllers\Supir;

use App\Http\Controllers\Controller;
use App\Models\Muatan as ModelsMuatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Muatan extends Controller
{
    public function index()
    {
        return view('supir.muatan.index');
    }

    public function create()
    {
        $option_operator = $this->option_operator(null);
        $option_supir = $this->option_supir(null);
        $option_bongkar_muat = $this->option_bongkar_muat(null);
        return view('supir.muatan.create', compact('option_operator', 'option_supir', 'option_bongkar_muat'));
    }

    public function store(Request $request)
    {
        $data = ModelsMuatan::create([
            'tgl' => $request->tgl,
            'operator' => Auth::user()->id,
            'bongkar_muat' => $request->bongkar_muat,
            'supir' => ($request->bongkar_muat == 'Ya' ? $request->supir : null),
            'kuantitas' => $request->kuantitas,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function show($id)
    {
        $data = ModelsMuatan::findOrFail($id);
        return view('supir.muatan.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelsMuatan::findOrFail($id);
        $option_operator = $this->option_operator($data->operator);
        $option_supir = $this->option_supir($data->supir);
        $option_bongkar_muat = $this->option_bongkar_muat($data->bongkar_muat);
        return view('supir.muatan.edit', compact('data', 'option_operator', 'option_supir', 'option_bongkar_muat'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelsMuatan::findOrFail($id);
        $data->update([
            'tgl' => $request->tgl,
            'bongkar_muat' => $request->bongkar_muat,
            'supir' => ($request->bongkar_muat == 'Ya' ? $request->supir : null),
            'kuantitas' => $request->kuantitas,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy(Request $request)
    {
        $data = ModelsMuatan::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus muatan.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsMuatan::orderBy('tgl')->where('supir', Auth::user()->id);
        return DataTables::of($data)
            ->addColumn('operator', function ($data) {
                return $data->get_operator->name;
            })
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('kuantitas', function ($data) {
                return $data->kuantitas . ' Truk';
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Supir Muatan Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }

    public function option_operator($pegawai)
    {
        $datas = User::where('status', '1')->role(['Operator Excavator'])->get();

        $option = '<option></option>';

        foreach ($datas as $data) {
            $option .= '<option value="' . $data->id . '" ' . ($data->id == $pegawai ? 'selected' : '') . '>' . $data->name . '</option>';
        }

        return $option;
    }

    public function option_supir($pegawai)
    {
        $datas = User::where('status', '1')->role(['Supir'])->get();

        $option = '<option></option>';

        foreach ($datas as $data) {
            $option .= '<option value="' . $data->id . '" ' . ($data->id == $pegawai ? 'selected' : '') . '>' . $data->name . '</option>';
        }

        return $option;
    }

    public function option_bongkar_muat($current)
    {
        $option = '
                    <option></option>
                    <option value="Ya" ' . ($current == 'Ya' ? 'selected' : '') . '>Ya</option>
                    <option value="Tidak" ' . ($current == 'Tidak' ? 'selected' : '') . '>Tidak</option>
                  ';

        return $option;
    }
}
