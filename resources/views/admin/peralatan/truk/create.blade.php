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
            {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', '') !!}
            {!! FormHelp::input_text(1, 'No. Plat', 'no_plat', 'No. Plat', '') !!}
            {!! FormHelp::select_with_option(1, 'Supir', $option_pegawai, 'supir', 'Supir', '') !!}
        </div>
        {!! FormHelp::form_footer(route('Admin Peralatan Truk')) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Peralatan Truk Create') }}
@endpush

@push('page_scripts')
    @include('js.admin.peralatan.truk.create')
@endpush

