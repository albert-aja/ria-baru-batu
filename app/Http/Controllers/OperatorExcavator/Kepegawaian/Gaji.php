<?php

namespace App\Http\Controllers\OperatorExcavator\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\Gaji as ModelsGaji;
use App\Models\Muatan;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Gaji extends Controller
{
    public function index()
    {
        return view('operator-excavator.kepegawaian.gaji.index');
    }

    public function create()
    {
        $option_pegawai = $this->option_pegawai(null);
        return view('operator-excavator.kepegawaian.gaji.create', compact('option_pegawai'));
    }

    public function dt()
    {
        $data = ModelsGaji::orderBy('tahun', 'desc')->orderBy('bulan', 'desc');
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Operator Excavator Kepegawaian Pegawai Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }

    public function option_pegawai($pegawai)
    {
        $datas = User::where('status', '1')->role(['Penjaga Tambang', 'Supir', 'Kernek', 'Operator Excavator'])->get();

        $option = '<option></option>';

        foreach ($datas as $data) {
            $option .= '<option value="' . $data->id . '" ' . ($data->id == $pegawai ? 'selected' : '') . '>' . $data->name . '</option>';
        }

        return $option;
    }

    public function req(Request $request)
    {
        if ($request->req == 'Detail Pegawai') {
            $pegawai = User::findOrFail($request->pegawai);
            $utang = $pegawai->get_total_utang();

            if ($pegawai->getRoleNames()->first() == 'Operator Excavator') {
                $role = 'Operator Excavator';
                $muatan = Muatan::where('operator', $pegawai->id)->where('tgl', 'LIKE', $request->periode . '%')->sum('kuantitas');
            }

            $return = array('utang' => $utang, 'muatan' => $muatan, 'role' => $role);
            echo json_encode($return);
        }
    }
}
