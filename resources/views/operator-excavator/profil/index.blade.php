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
                    <th style="width:20%">Nama</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>{{ Auth::user()->tlp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ Auth::user()->username }}</td>
                </tr>
                <tr>
                    <th>Level Akses</th>
                    <td>{{ Auth::user()->getRoleNames()->first() }}</td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer(Auth::user(), array(1,0,0), route('Operator Excavator Profil Edit'), '', '', '') !!}
    </div>
@endsection

@push('breadcrumbs')

@endpush

@push('page_scripts')
    @include('js.operator-excavator.profil.index')
@endpush

