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
                    <th style="width: 20%;">Customer</th>
                    <td>{{ $data->customer }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') }}</td>
                </tr>
                <tr>
                    <th>Harga Jual</th>
                    <td>{{ GeneralHelp::get_numeral(1, $data->harga_jual) }}</td>
                </tr>
                <tr>
                    <th>Kuantitas</th>
                    <td>{{ $data->kuantitas }} Truk</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{ GeneralHelp::get_numeral(1, ($data->harga_jual * $data->kuantitas)) }}</td>
                </tr>
                <tr>
                    <th>Faktur</th>
                    <td>
                        <a target="_blank" href="{{ route('Owner Penjualan Customer Invoice', $data) }}" class="btn btn-sm btn-success">Lihat</a> 
                    </td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Owner Penjualan Customer Edit', $data), route('Owner Penjualan Customer Destroy'), route('Owner Penjualan Customer'), 'Anda yakin ingin menghapus penjualan customer ini?') !!}
    </div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Penjualan Customer Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.penjualan.customer.show')
@endpush

