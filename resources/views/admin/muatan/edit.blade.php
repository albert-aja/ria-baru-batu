@extends('layouts.app')

@section('content')
<div class="box box-blue">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Data</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <form class="form-horizontal" id="Form" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            {!! FormHelp::input_datetime(1, 'Tanggal', 'tgl', 'Tanggal', date('Y-m-d')) !!}
            {!! FormHelp::select_with_option(1, 'Operator', $option_operator, 'operator', 'Operator', '') !!}
            {!! FormHelp::select_with_option(1, 'Bongkar Muat Gudang', $option_bongkar_muat, 'bongkar_muat', 'Bongkar Muat Gudang', '') !!}
            <div id="cotainer_supir" class="form-group" {!! ($data->bongkar_muat == 'Tidak' ? 'style="display: none;"' : '') !!}>
                <label for="supir" class="col-sm-2 control-label">Supir</label>
                <div class="col-sm-10">
                    {!! FormHelp::select_with_option(0, 'Supir', $option_supir, 'supir', 'Supir', '') !!}
                </div>
            </div>
            {!! FormHelp::input_text_with_back_addon(1, 'Kuantitas', 'kuantitas', 'Kuantitas', $data->kuantitas, 'Truk') !!}
        </div>
        {!! FormHelp::form_footer(route('Admin Muatan Show', $data)) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Muatan Edit', $data->id) }}
@endpush

@push('page_scripts')
@include('js.admin.muatan.edit')
@endpush

