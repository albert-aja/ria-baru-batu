<?php

namespace App\Http\Controllers\Admin\Penjualan;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\PenjualanTrip;
use App\Models\Truk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Trip extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.penjualan.trip.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $option_supir = $this->option_supir(null);
        return view('admin.penjualan.trip.create', compact('option_supir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $truk = Truk::where('supir', $request->supir)->first();
        $data = PenjualanTrip::create([
            'tgl' => $request->tgl,
            'asal' => $request->asal,
            'supir' => $request->supir,
            'truk' => $truk->id,
            'tonase' => $request->tonase,
            'harga_tonase' => $request->harga_tonase,
            'uang_jalan' => $request->uang_jalan,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PenjualanTrip::findOrFail($id);
        return view('admin.penjualan.trip.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PenjualanTrip::findOrFail($id);
        $option_supir = $this->option_supir($data->supir);
        return view('admin.penjualan.trip.edit', compact('data', 'option_supir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $truk = Truk::where('supir', $request->supir)->first();
        $data = PenjualanTrip::findOrFail($id);
        $data->update([
            'tgl' => $request->tgl,
            'asal' => $request->asal,
            'supir' => $request->supir,
            'truk' => $truk->id,
            'tonase' => $request->tonase,
            'harga_tonase' => $request->harga_tonase,
            'uang_jalan' => $request->uang_jalan,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = PenjualanTrip::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus penjualan trip.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = PenjualanTrip::orderBy('tgl', 'desc');
        return DataTables::of($data)
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('asal', function ($data) {
                return $data->get_asal->nama;
            })
            ->editColumn('supir', function ($data) {
                return $data->get_supir->name;
            })
            ->editColumn('truk', function ($data) {
                return $data->get_truk->nama;
            })
            ->editColumn('tonase', function ($data) {
                return General::get_numeral(0, $data->tonase);
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Admin Penjualan Trip Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
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
}
