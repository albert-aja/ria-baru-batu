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
            {!! FormHelp::select_with_option(1, 'Jenis', $option_jenis, 'jenis', 'Jenis', '') !!}
            {!! FormHelp::select_with_option(1, 'Unit', '', 'peralatan', 'Unit', '') !!}
            {!! FormHelp::input_text_with_front_addon(1, 'Nominal', 'nominal', 'Nominal', '', 'Rp.') !!}
            {!! FormHelp::textarea(1, 'Keterangan', 'keterangan', 'Keterangan', '') !!}
        </div>
        {!! FormHelp::form_footer(route('Owner Peralatan Operasional')) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Peralatan Operasional Create') }}
@endpush

@push('page_scripts')
    @include('js.owner.peralatan.operasional.create')
@endpush

