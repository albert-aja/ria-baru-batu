<?php

namespace App\Http\Controllers\Owner\Penjualan;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\PenjualanCustomer;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.penjualan.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.penjualan.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = PenjualanCustomer::create([
            'customer' => $request->customer,
            'tgl' => $request->tgl,
            'harga_jual' => $request->harga_jual,
            'kuantitas' => $request->kuantitas,
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
        $data = PenjualanCustomer::findOrFail($id);
        return view('owner.penjualan.customer.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PenjualanCustomer::findOrFail($id);
        return view('owner.penjualan.customer.edit', compact('data'));
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
        $data = PenjualanCustomer::findOrFail($id);
        $data->update([
            'customer' => $request->customer,
            'tgl' => $request->tgl,
            'harga_jual' => $request->harga_jual,
            'kuantitas' => $request->kuantitas,
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function invoice($id)
    {
        $data = PenjualanCustomer::findOrFail($id);

        $this->extend();

        $pdf = PDF::loadView('owner.penjualan.customer.invoice', compact('data'));
        return $pdf->stream('Faktur Penjualan ' . $data->id . '.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = PenjualanCustomer::findOrFail($request->id);

        if ($data->delete()) {
            $return_status = 'Valid';
        } else {
            $return_status = 'Tidak Valid';
        }

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus penjualan customer.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = PenjualanCustomer::orderBy('tgl', 'desc');
        return DataTables::of($data)
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('kuantitas', function ($data) {
                return $data->kuantitas . ' Truk';
            })
            ->editColumn('harga_jual', function ($data) {
                return General::get_numeral(1, $data->harga_jual);
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Owner Penjualan Customer Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }
}
