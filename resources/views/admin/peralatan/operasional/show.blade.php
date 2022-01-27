@extends('layouts.app')

@section('content')
    <div class="box box-blue">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Data</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <th style="width:20%">Tanggal</th>
                    <td>{{ Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') }}<br></td>
                </tr>
                <tr>
                    <th>Jenis</th>
                    <td>{{ $data->jenis }}</td>
                </tr>
                <tr>
                    <th>Unit</th>
                    <td>
                        {{ ($data->jenis == 'Truk' ? $data->get_truk->nama.' ['.$data->get_truk->no_plat.']' : $data->get_excavator->nama) }}<br>
                    </td>
                </tr>
                <tr>
                    <th>Pegawai</th>
                    <td>{{ $data->get_pegawai->name }}</td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>{{ GeneralHelp::get_numeral(1, $data->nominal) }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $data->keterangan }}</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Admin Peralatan Operasional Edit', $data), route('Admin Peralatan Operasional Destroy'), route('Admin Peralatan Operasional'), 'Anda yakin ingin menghapus operasional ini?') !!}
    </div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Peralatan Operasional Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.admin.peralatan.operasional.show')
@endpush

