<?php

namespace App\Http\Controllers\Supir;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Excavator;
use App\Models\Operasional as ModelsOperasional;
use App\Models\Truk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class Operasional extends Controller
{
    public function index()
    {
        return view('supir.operasional.index');
    }

    public function create()
    {
        return view('supir.operasional.create');
    }

    public function store(Request $request)
    {
        $peralatan = Truk::where('supir', Auth::user()->id)->first();

        $data = ModelsOperasional::create([
            'tgl' => $request->tgl,
            'jenis' => 'Truk',
            'peralatan' => $peralatan->id,
            'pegawai' => Auth::user()->id,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function show($id)
    {
        $data = ModelsOperasional::findOrFail($id);
        return view('supir.operasional.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelsOperasional::findOrFail($id);
        return view('supir.operasional.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelsOperasional::findOrFail($id);

        $data->update([
            'tgl' => $request->tgl,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy(Request $request)
    {
        $data = ModelsOperasional::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus operasional.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsOperasional::orderBy('tgl')->where('pegawai', Auth::user()->id);
        return DataTables::of($data)
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('peralatan', function ($data) {
                if ($data->jenis == 'Truk') {
                    $peralatan = $data->get_truk->nama;
                } else {
                    $peralatan = $data->get_excavator->nama;
                }
                return $peralatan;
            })
            ->editColumn('pegawai', function ($data) {
                return $data->get_pegawai->name;
            })
            ->editColumn('nominal', function ($data) {
                return General::get_numeral(1, $data->nominal);
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Supir Operasional Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }

    public function option_jenis($jenis)
    {
        $option = '
                    <option></option>
                    <option value="Truk" ' . ($jenis == 'Truk' ? 'selected' : '') . '>Truk</option>
                    <option value="Excavator" ' . ($jenis == 'Excavator' ? 'selected' : '') . '>Excavator</option>
                  ';

        return $option;
    }

    public function req(Request $request)
    {
        if ($request->req == 'Option Unit') {
            if ($request->jenis == 'Truk') {
                $option_datas = Truk::orderBy('nama')->get();
                $option = '<option></option>';

                foreach ($option_datas as $option_data) {
                    $option .= '<option value="' . $option_data->id . '">' . $option_data->nama . ' [' . $option_data->no_plat . '] (' . $option_data->get_supir->name . ')</option>';
                }
            } else {
                $option_datas = Excavator::orderBy('nama')->get();
                $option = '<option></option>';

                foreach ($option_datas as $option_data) {
                    $option .= '<option value="' . $option_data->id . '">' . $option_data->nama . ' (' . $option_data->get_operator->name . ')</option>';
                }
            }

            return $option;
        }
    }
}
