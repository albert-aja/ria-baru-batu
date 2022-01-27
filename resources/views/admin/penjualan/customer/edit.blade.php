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
            {!! FormHelp::input_text(1, 'Customer', 'customer', 'Customer', $data->customer) !!}
            {!! FormHelp::input_datetime(1, 'Tanggal', 'tgl', 'Tanggal', $data->tgl) !!}
            {!! FormHelp::input_text_with_front_addon(1, 'Harga Jual', 'harga_jual', 'Harga Jual', $data->harga_jual, 'Rp.') !!}
            {!! FormHelp::input_text_with_back_addon(1, 'Kuantitas', 'kuantitas', 'Kuantitas', $data->kuantitas, 'Truk') !!}
        </div>
        {!! FormHelp::form_footer(route('Admin Penjualan Customer Show', $data)) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Penjualan Customer Edit', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.admin.penjualan.customer.edit')
@endpush

