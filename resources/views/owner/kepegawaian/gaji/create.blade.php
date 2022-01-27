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
            <div class="form-group">
                <label for="periode" class="col-sm-2 control-label">Periode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control main_trigger datetimepicker-input" id="periode" name="periode" data-toggle="datetimepicker" data-target="#periode" value="{{ date('Y-m') }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="pegawai" class="col-sm-2 control-label">Pegawai</label>
                <div class="col-sm-10">
                    <select class="form-control select2 main_trigger" style="width: 100%;" name="pegawai" id="pegawai" data-placeholder="Pegawai">
                        {!! $option_pegawai !!}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="pinjaman" class="col-sm-2 control-label">Pinjaman</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">Rp. </span>
                        <input type="text" class="form-control minus_operation" id="pinjaman" name="pinjaman" placeholder="Pinjaman" value="" readonly />
                    </div>
                </div>
            </div>
            <div id="pekerjaan">
            </div>
            <div class="form-group">
                <label for="pinjaman" class="col-sm-2 control-label">Total Gaji</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">Rp. </span>
                        <input type="text" class="form-control" id="total_gaji" name="total_gaji" placeholder="Total Gaji" value="" readonly />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="pinjaman" class="col-sm-2 control-label">Diterima</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">Rp. </span>
                        <input type="text" class="form-control" id="diterima" name="diterima" placeholder="Diterima" value="" readonly />
                    </div>
                </div>
            </div>
        </div>
        {!! FormHelp::form_footer(route('Owner Kepegawaian Gaji')) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Kepegawaian Gaji Create') }}
@endpush

@push('page_scripts')
    @include('js.owner.kepegawaian.gaji.create')
@endpush

