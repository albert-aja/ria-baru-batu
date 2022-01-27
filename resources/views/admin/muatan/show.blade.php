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
                    <th>Operator</th>
                    <td>{{ $data->get_operator->name }}</td>
                </tr>
                <tr>
                    <th>Bongkar Muat Gudang</th>
                    <td>{{ $data->bongkar_muat }}</td>
                </tr>
                <tr {!! ($data->bongkar_muat == 'Tidak' ? 'style="display: none;"' : '') !!}>
                    <th>Supir</th>
                    <td>{{ ($data->supir ? $data->get_supir->name : '') }}</td>
                </tr>
                <tr>
                    <th>Kuantitas</th>
                    <td>{{ $data->kuantitas }} Truk</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Admin Muatan Edit', $data), route('Admin Muatan Destroy'), route('Admin Muatan'), 'Anda yakin ingin menghapus muatan ini?') !!}
    </div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Muatan Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.admin.muatan.show')
@endpush

