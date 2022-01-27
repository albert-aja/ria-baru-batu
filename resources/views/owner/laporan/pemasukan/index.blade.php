@extends('layouts.app')

@section('content')
<div class="box box-blue">
    <div class="box-header with-border">
        <h3 class="box-title">Filter Laporan</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        {!! FormHelp::select_with_option(1, 'Kategori', $option_kategori, 'kategori', 'Kategori') !!}
        <div class="form-group" style="margin-top: 50px !important;">
            <label for="waktu_transaksi" class="col-sm-2 control-label">Periode</label>
            <div class="col-sm-5">
                {!! FormHelp::input_datetime(0, 'Periode Awal', 'periode_awal', 'Periode Awal', date('Y-m-d')) !!}
            </div>
            <div class="col-sm-5">
                {!! FormHelp::input_datetime(0, 'Periode Akhir', 'periode_akhir', 'Periode Akhir', date('Y-m-d')) !!}
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <TombolLihat class="btn btn-sm btn-primary">Lihat</TombolLihat>
            </div>
        </div>
    </div>
</div>

<div class="box box-blue">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Data</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered">
            <thead>
                <tr class="bg-custom">
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Laporan Pemasukan') }}
@endpush

@push('page_scripts')
    @include('js.owner.laporan.pemasukan.index')
@endpush

