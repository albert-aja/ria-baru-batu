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
                    <td>{{ $data->nama }}</td>
                </tr>
                <tr>
                    <th>Operator</th>
                    <td>
                        {{ ($data->get_operator ? $data->get_operator->name : 'Tidak Ada') }}<br>
                    </td>
                </tr>
            </table>
        </div>
        {!! GeneralHelp::get_default_show_footer($data, array(1,1,1), route('Owner Peralatan Excavator Edit', $data), route('Owner Peralatan Excavator Destroy'), route('Owner Peralatan Excavator'), 'Anda yakin ingin menghapus excavator ini?') !!}
    </div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Peralatan Excavator Show', $data->id) }}
@endpush

@push('page_scripts')
    @include('js.owner.peralatan.excavator.show')
@endpush

