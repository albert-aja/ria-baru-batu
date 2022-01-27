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
                <th>Periode</th>
                <td>
                    {{ Carbon::parse($data->tahun . '-' . $data->bulan)->isoFormat('MMMM Y') }}<br>
                </td>
            </tr>
            <tr>
                <th>Total Gaji</th>
                <td>{{ GeneralHelp::get_numeral(1, $data->nominal) }}</td>
            </tr>
            <tr>
                <th>Pembayaran Pinjaman</th>
                <td>{{ GeneralHelp::get_numeral(1, $data->get_total_pembayaran_pinjaman()) }}</td>
            </tr>
            <tr>
                <th>Diterima</th>
                <td>{{ GeneralHelp::get_numeral(1, $data->nominal - $data->get_total_pembayaran_pinjaman()) }}</td>
            </tr>
        </table>
    </div>
    {!! GeneralHelp::get_default_show_footer($data, array(0,1,1), '', route('Owner Kepegawaian Gaji Destroy'), route('Owner Kepegawaian Gaji'), 'Anda yakin ingin menghapus gaji ini?') !!}
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="box box-blue">
            <div class="box-header with-border">
                <h3 class="box-title">Pembayaran Pinjaman</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="daftar_data_1" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr class="bg-custom">
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    @if($data->get_pembayaran_pinjaman->count() != 0)
                        <tbody>
                        @foreach($data->get_pembayaran_pinjaman as $pinjaman)
                            <tr>
                                <td>{{ Carbon::parse($pinjaman->get_pinjaman->tgl)->isoFormat('dddd, D MMMM Y') }}</td>
                                <td>{{ GeneralHelp::get_numeral(1, $pinjaman->get_pinjaman->nominal) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="2">Tidak Ada Data</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="box box-blue">
            <div class="box-header with-border">
                <h3 class="box-title">Pekerjaan Muatan</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="daftar_data_1" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr class="bg-custom">
                            <th>Tanggal</th>
                            <th>Kuantitas</th>
                            <th>Harga/Truk</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    @if($data->get_pekerjaan_muatan()->count() != 0)
                        <tbody>
                        @foreach($data->get_pekerjaan_muatan() as $pekerjaan)
                            <tr>
                                <td>{{ Carbon::parse($pekerjaan->tgl)->isoFormat('dddd, D MMMM Y') }}</td>
                                <td>{{ GeneralHelp::get_numeral(0, $pekerjaan->kuantitas) }} Meter</td>
                                <td>{{ GeneralHelp::get_numeral(1, $pekerjaan->gaji) }}</td>
                                <td>{{ GeneralHelp::get_numeral(1, $pekerjaan->gaji * $pekerjaan->kuantitas) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="3">Tidak Ada Data</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>

        <div class="box box-blue">
            <div class="box-header with-border">
                <h3 class="box-title">Pengiriman</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="daftar_data_1" style="width: 100%;" class="table table-bordered">
                    <thead>
                        <tr class="bg-custom">
                            <th>Tanggal</th>
                            <th>Tonase</th>
                            <th>Uang Jalan</th>
                        </tr>
                    </thead>
                    @if($data->get_pekerjaan_pengiriman()->count() != 0)
                        <tbody>
                        @foreach($data->get_pekerjaan_pengiriman() as $pekerjaan)
                            <tr>
                                <td>{{ Carbon::parse($pekerjaan->tgl)->isoFormat('dddd, D MMMM Y') }}</td>
                                <td>{{ GeneralHelp::get_numeral(0, $pekerjaan->tonase) }}</td>
                                <td>{{ GeneralHelp::get_numeral(1, $pekerjaan->uang_jalan) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="3">Tidak Ada Data</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Kepegawaian Gaji Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.kepegawaian.gaji.show')
@endpush

