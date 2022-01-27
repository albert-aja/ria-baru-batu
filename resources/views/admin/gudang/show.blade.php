@extends('layouts.app')

@section('content')
<div class="box box-blue">
    <div class="box-header with-border">
        <h3 class="box-title">Detail Transaksi Gudang</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <table class="table">
            <tr>
                <th style="width:20%">Judul</th>
                <td>{{ $data->judul }}</td>
            </tr>
            <tr>
                <th>Kondisi</th>
                <td>{{ $data->kondisi }}</td>
            </tr>
            <tr>
                <th>Waktu Transaksi</th>
                <td>
                    {{ Carbon::parse($data->waktu_transaksi)->isoFormat('dddd, D MMMM Y') }}<br>
                    <i>{{ Carbon::parse($data->waktu_transaksi)->isoFormat('HH:mm:ss') }}</i><br>
                    <i>[{{ Carbon::parse($data->waktu_transaksi)->diffForHumans() }}]</i>
                </td>
            </tr>
            <tr>
                <th>Kuantitas</th>
                <td>{{ GeneralHelp::get_numeral(0, $data->kuantitas) }} Truk</td>
            </tr>
            <tr>
                <th>Detail</th>
                <td>
                    <a href="{{ ($data->judul == 'Penambahan Muatan' ? route('Admin Muatan Show', ['id' => $data->id]) : ($data->judul == 'Penjualan Trip' ? route('Admin Penjualan Trip Show', ['id' => $data->id]) : route('Admin Penjualan Customer Show', ['id' => $data->id]))) }}" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                </td>
            </tr>
        </table>
    </div>
    {!! GeneralHelp::get_default_show_footer($data, array(0,0,1), route('Admin Gudang Edit', $data), route('Admin Gudang Destroy'), route('Admin Gudang'), 'Anda yakin ingin menghapus transaksi laci ini?') !!}
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Gudang Show', $data->id) }}
@endpush

@push('page_scripts')

@endpush

