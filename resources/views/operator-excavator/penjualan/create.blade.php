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
            {!! FormHelp::select_with_option(1, 'Supir', $option_supir, 'supir', 'Supir', '') !!}
            {!! FormHelp::select(1, 'ref_asal', 'id', array('nama'), '$0$', 'Asal', 'asal', 'Asal', '', 'id != "" AND deleted_at is null') !!}
            {!! FormHelp::input_text_with_front_addon(1, 'Uang Jalan', 'uang_jalan', 'Uang Jalan', '', 'Rp.') !!}
            {!! FormHelp::input_text(1, 'Tonase', 'tonase', 'Tonase', '') !!}
            {!! FormHelp::input_text_with_front_addon(1, 'Harga Pertonase', 'harga_tonase', 'Harga Pertonase', '', 'Rp.') !!}
        </div>
        {!! FormHelp::form_footer(route('Operator Excavator Penjualan Trip')) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')

@endpush

@push('page_scripts')
    @include('js.operator-excavator.penjualan.trip.create')
@endpush

