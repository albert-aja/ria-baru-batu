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
                    <th style="width:20%">Pegawai</th>
                    <td>{{ $data->get_pegawai->name }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>
                        {{ Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') }}<br>
                    </td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>{{ GeneralHelp::get_numeral(1, $data->nominal) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        {{ $data->get_status->nama }}
                        @if($data->get_status->nama == 'Belum Lunas')
                            <br><TombolLunaskan value="{{ $data->id }}" class="btn btn-sm btn-primary">Lunaskan</TombolLunaskan>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Admin Kepegawaian Pinjaman Edit', $data), route('Admin Kepegawaian Pinjaman Destroy'), route('Admin Kepegawaian Pinjaman'), 'Anda yakin ingin menghapus pegawai ini?') !!}
    </div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Kepegawaian Pinjaman Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.admin.kepegawaian.pinjaman.show')
@endpush

