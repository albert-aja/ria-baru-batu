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
                    <th style="width:20%">Level Akses</th>
                    <td>{{ $data->getRoleNames()->first() }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>{{ $data->tlp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $data->username }}</td>
                </tr>                
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Admin Kepegawaian Pegawai Edit', $data), route('Admin Kepegawaian Pegawai Destroy'), route('Admin Kepegawaian Pegawai'), 'Anda yakin ingin menghapus pegawai ini?') !!}
    </div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Kepegawaian Pegawai Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.admin.kepegawaian.pegawai.show')
@endpush

