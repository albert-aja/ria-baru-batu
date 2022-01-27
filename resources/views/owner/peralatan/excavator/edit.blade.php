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
            {!! FormHelp::input_text(1, 'Nama', 'nama', 'Nama', $data->nama) !!}
            {!! FormHelp::select_with_option(1, 'Operator', $option_pegawai, 'operator', 'Operator', '') !!}
        </div>
        {!! FormHelp::form_footer(route('Owner Peralatan Excavator Show', $data)) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Peralatan Excavator Edit', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.peralatan.excavator.edit')
@endpush