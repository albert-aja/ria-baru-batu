<?php

namespace App\Http\Controllers\Owner\Laporan;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\View\Laporan\Pengeluaran as LaporanPengeluaran;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class Pengeluaran extends Controller
{
    public function index()
    {
        $option_kategori = $this->option_kategori();
        return view('owner.laporan.pengeluaran.index', compact('option_kategori'));
    }

    public function dt($awal, $akhir, $kategori)
    {
        $data = LaporanPengeluaran::whereBetween('tgl', [$awal, $akhir])->where('kategori', ($kategori == 'Semua' ? '!=' : '='), ($kategori == 'Semua' ? 'OK' : $kategori))->orderBy('tgl', 'desc');
        return DataTables::of($data)
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('nominal', function ($data) {
                return General::get_numeral(1, $data->nominal);
            })
            ->make(true);
    }

    public function option_kategori()
    {
        $option = '
                    <option></option>
                    <option value="Semua" selected>Semua</option>
                    <option value="Operasional">Operasional</option>
                    <option value="Pembayaran Gaji">Pembayaran Gaji</option>
                  ';

        return $option;
    }
}
