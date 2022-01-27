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
            {!! FormHelp::input_datetime(1, 'Periode', 'periode', 'Periode', date('Y-m')) !!}
            {!! FormHelp::select_with_option(1, 'Pegawai', $option_pegawai, 'pegawai', 'Pegawai', '') !!}
            <div class="form-group">
                <label for="role" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="role" name="role" value="" readonly />
                </div>
            </div>
            <div class="form-group for_operator_excavator">
                <label for="pinjaman" class="col-sm-2 control-label">Muatan</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" class="form-control" id="muatan_operator_excavator" name="muatan_operator_excavator" placeholder="Muatan" value="" readonly />
                        <span class="input-group-addon">Truk</span>
                    </div>
                </div>
            </div>
            <div class="form-group for_operator_excavator">
                <label for="pinjaman" class="col-sm-2 control-label">Gaji</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input type="text" class="form-control" id="gaji_operator_excavator" name="gaji_operator_excavator" placeholder="Gaji" value="" />
                        <span class="input-group-addon">Per Muatan</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="pinjaman" class="col-sm-2 control-label">Pinjaman</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pinjaman" name="pinjaman" placeholder="Pinjaman" value="" readonly />
                </div>
            </div>
            <div class="form-group">
                <label for="diterima" class="col-sm-2 control-label">Diterima</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="diterima" name="diterima" placeholder="Diterima" value="" readonly />
                </div>
            </div>
        </div>
        {!! FormHelp::form_footer(route('Supir Kepegawaian Gaji')) !!}
    </form>
</div>
@endsection

@push('breadcrumbs')

@endpush

@push('page_scripts')
    @include('js.supir.kepegawaian.gaji.create')
@endpush

