<?php

namespace App\Http\Controllers\Owner\Kepegawaian;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Pinjaman as ModelsPinjaman;
use App\Models\Ref\PinjamanStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Pinjaman extends Controller
{
    public function index()
    {
        return view('owner.kepegawaian.pinjaman.index');
    }

    public function create()
    {
        $option_pegawai = $this->option_pegawai(null);
        return view('owner.kepegawaian.pinjaman.create', compact('option_pegawai'));
    }

    public function store(Request $request)
    {
        $status = PinjamanStatus::where('nama', 'Belum Lunas')->first();
        $data = ModelsPinjaman::create([
            'pegawai' => $request->pegawai,
            'tgl' => $request->tgl,
            'nominal' => $request->nominal,
            'status' => $status->id,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function show($id)
    {
        $data = ModelsPinjaman::findOrFail($id);
        return view('owner.kepegawaian.pinjaman.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelsPinjaman::findOrFail($id);
        $option_pegawai = $this->option_pegawai($data->pegawai);
        return view('owner.kepegawaian.pinjaman.edit', compact('data', 'option_pegawai'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelsPinjaman::findOrFail($id);
        $data->update([
            'pegawai' => $request->pegawai,
            'tgl' => $request->tgl,
            'nominal' => $request->nominal,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy(Request $request)
    {
        $data = ModelsPinjaman::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus pinjaman.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsPinjaman::orderBy('tgl', 'desc');
        return DataTables::of($data)
            ->editColumn('pegawai', function ($data) {
                return $data->get_pegawai->name;
            })
            ->editColumn('nominal', function ($data) {
                return General::get_numeral(1, $data->nominal);
            })
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('status', function ($data) {
                return $data->get_status->nama;
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Owner Kepegawaian Pinjaman Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
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
        if ($request->req == 'Pelunasan') {
            $data = ModelsPinjaman::findOrFail($request->id);
            $status = PinjamanStatus::where('nama', 'Lunas')->first();
            $data->update([
                'status' => $status->id,
            ]);

            $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

            $return = array('id' => $data->id, 'status' => $return_status);
            echo json_encode($return);
        }
    }
}
