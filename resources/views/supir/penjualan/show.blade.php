@extends('layouts.app')

@section('content')
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <th style="width:20%">Tanggal</th>
                    <td>{{ Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') }}</td>
                </tr>
                <tr>
                    <th>Supir</th>
                    <td>{{ $data->get_supir->name }}</td>
                </tr>
                <tr>
                    <th>Truk</th>
                    <td>{{ $data->get_truk->nama }}</td>
                </tr>
                <tr>
                    <th>Uang Jalan</th>
                    <td>{{ GeneralHelp::get_numeral(1, $data->uang_jalan) }}</td>
                </tr>
                <tr>
                    <th>Tonase</th>
                    <td>{{ $data->tonase }}</td>
                </tr>
                <tr>
                    <th>Harga Pertonase</th>
                    <td>{{ GeneralHelp::get_numeral(1, $data->harga_tonase) }}</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Supir Penjualan Trip Edit', $data), route('Supir Penjualan Trip Destroy'), route('Supir Penjualan Trip'), 'Anda yakin ingin menghapus penjualan trip ini?') !!}
    </div>
@endsection

@push('breadcrumbs')

@endpush

@push('page_scripts')
    @include('js.supir.penjualan.trip.show')
@endpush

