@extends('layouts.app')

@section('content')
<div class="box box-blue">
    <div class="box-header with-border">
        <h3 class="box-title">Sunting Data</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <form class="form-horizontal" id="Form" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            {!! FormHelp::input_datetime(1, 'Tanggal', 'tgl', 'Tanggal', $data->tgl) !!}
            {!! FormHelp::select_with_option(1, 'Jenis', $option_jenis, 'jenis', 'Jenis', '') !!}
            {!! FormHelp::select(1, ($data->jenis == 'Truk' ? 'truk' : 'excavator'), 'id', array('nama'), '$0$', 'Peralatan', 'peralatan', 'Peralatan', $data->peralatan, 'id != "" AND deleted_at is null') !!}
            {!! FormHelp::input_text_with_front_addon(1, 'Nominal', 'nominal', 'Nominal', $data->nominal, 'Rp.') !!}
            {!! FormHelp::textarea(1, 'Keterangan', 'keterangan', 'Keterangan', $data->keterangan) !!}
        </div>
        {!! FormHelp::form_footer(route('Owner Peralatan Operasional Show', $data)) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Peralatan Operasional Edit', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.peralatan.operasional.edit')
@endpush