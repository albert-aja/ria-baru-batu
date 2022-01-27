<?php

namespace App\Http\Controllers\Admin\Kepegawaian;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Gaji as ModelsGaji;
use App\Models\GajiPembayaranPinjaman;
use App\Models\Muatan;
use App\Models\PenjualanTrip;
use App\Models\Pinjaman;
use App\Models\Ref\PinjamanStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Gaji extends Controller
{
    public function index()
    {
        return view('admin.kepegawaian.gaji.index');
    }

    public function create()
    {
        $option_pegawai = $this->option_pegawai(null);
        return view('admin.kepegawaian.gaji.create', compact('option_pegawai'));
    }

    public function store(Request $request)
    {
        $pegawai = User::findOrFail($request->pegawai);
        $data = ModelsGaji::create([
            'pegawai' => $request->pegawai,
            'tahun' => explode('-', $request->periode)[0],
            'bulan' => explode('-', $request->periode)[1],
            'nominal' => $request->total_gaji,
        ]);

        $pinjamans = Pinjaman::where('pegawai', $request->pegawai)->whereHas('get_status', function ($query) {
            return $query->where('nama', 'Belum Lunas');
        })->get();
        $gaji = $request->total_gaji;
        foreach ($pinjamans as $pinjaman) {
            if ($gaji > $pinjaman->nominal) {
                $status = PinjamanStatus::where('nama', 'Lunas')->first();
                $pinjaman->update([
                    'status_pembayaran' => $status->id,
                ]);

                $pinjaman_pembayaran = GajiPembayaranPinjaman::create([
                    'gaji' => $data->id,
                    'pinjaman' => $pinjaman->id,
                ]);

                $gaji -= $pinjaman->nominal;
            }
        }

        if ($pegawai->getRoleNames()->first() == 'Operator Excavator') {
            $muatan = ($request->muatan ? $request->muatan : 0);

            Muatan::where('operator', $request->pegawai)->where('tgl', 'LIKE', $request->periode . '%')->update([
                'gaji' => $muatan,
            ]);
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function show($id)
    {
        $data = ModelsGaji::findOrFail($id);
        return view('admin.kepegawaian.gaji.show', compact('data'));
    }

    public function destroy(Request $request)
    {
        $data = ModelsGaji::findOrFail($request->id);

        $pembayarans = GajiPembayaranPinjaman::where('gaji', $data->id)->get();

        foreach ($pembayarans as $pembayaran) {
            $status = PinjamanStatus::where('nama', 'Belum Lunas')->first();
            $pembayaran->get_pinjaman->update([
                'status_pembayaran' => $status->id,
            ]);
        }

        GajiPembayaranPinjaman::where('gaji', $data->id)->delete();
        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus gaji.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = ModelsGaji::orderBy('tahun', 'desc')->orderBy('bulan', 'desc');
        return DataTables::of($data)
            ->editColumn('pegawai', function ($data) {
                return $data->get_pegawai->name;
            })
            ->addColumn('periode', function ($data) {
                return Carbon::parse($data->tahun . '-' . $data->bulan)->isoFormat('MMMM Y');
            })
            ->addColumn('pembayaran_pinjaman', function ($data) {
                return General::get_numeral(1, $data->get_total_pembayaran_pinjaman());
            })
            ->editColumn('nominal', function ($data) {
                return General::get_numeral(1, $data->nominal);
            })
            ->editColumn('diterima', function ($data) {
                return General::get_numeral(1, $data->nominal - $data->get_total_pembayaran_pinjaman());
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Admin Kepegawaian Gaji Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
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
        if ($request->req == 'Pinjaman') {
            $pegawai = User::findOrFail($request->pegawai);
            $utang = $pegawai->get_total_utang();

            $return = array('utang' => $utang);
            echo json_encode($return);
        } else if ($request->req == 'Pekerjaan') {
            $pegawai = User::findOrFail($request->pegawai);

            if ($pegawai->getRoleNames()->first() == 'Penjaga Tambang' or $pegawai->getRoleNames()->first() == 'Kernek') {
                $form = '
                            <div class="form-group">
                                <label for="pekerjaan" class="col-sm-2 control-label">Gaji Pokok</label>
                                <div class="col-sm-10" id="pekerjaan_container">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp.</span>
                                        <input type="text" class="form-control plus_operation times_operation" id="subtotal" name="subtotal" placeholder="Gaji Pokok" value="" />
                                    </div>
                                </div>
                            </div>
                        ';

                $return = array('form' => $form);
                echo json_encode($return);
            } else if ($pegawai->getRoleNames()->first() == 'Operator Excavator') {
                $form = '';
                $total_pekerjaan = Muatan::where('operator', $pegawai->id)->where('tgl', 'LIKE', $request->periode . '%')->sum('kuantitas');

                if ($total_pekerjaan != 0) {
                    $form .= '
                                <div class="form-group">
                                    <label for="pekerjaan" class="col-sm-2 control-label">Muatan</label>
                                    <div class="col-sm-5" id="pekerjaan_container">
                                        <div class="input-group">
                                            <input type="text" class="form-control times_operation" id="pekerjaan" name="pekerjaan" placeholder="Muatan" value="' . $total_pekerjaan . '" readonly />
                                            <span class="input-group-addon">Truk</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control times_operation" id="harga_pekerjaan" name="muatan" placeholder="Harga/Truk" value="" />
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control plus_operation" id="subtotal" name="subtotal" placeholder="" value="" />
                                </div>
                             ';
                }

                $return = array('form' => $form);
                echo json_encode($return);
            } else if ($pegawai->getRoleNames()->first() == 'Supir') {
                $form = '';

                $total_pekerjaan = PenjualanTrip::where('supir', $pegawai->id)->where('tgl', 'LIKE', $request->periode . '%')->sum('uang_jalan');

                if ($total_pekerjaan != 0) {
                    $form .= '
                                <div class="form-group">
                                    <label for="pekerjaan" class="col-sm-2 control-label">Pengiriman</label>
                                    <div class="col-sm-10" id="pekerjaan_container">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp. </span>
                                            <input type="text" class="form-control times_operation" id="pekerjaan" name="pekerjaan" placeholder="Pengiriman DO Owner" value="' . $total_pekerjaan . '" readonly />
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control plus_operation" id="subtotal" name="subtotal" placeholder="" value="' . $total_pekerjaan . '" />
                                </div>
                             ';
                }

                $return = array('form' => $form);
                echo json_encode($return);
            }
        }
    }
}
