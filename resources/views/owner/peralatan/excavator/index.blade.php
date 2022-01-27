@extends('layouts.app')

@section('content')
<div class="box box-blue">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Data</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
            <thead>
                <tr class="bg-custom">
                    <th>Nama</th>
                    <th>Operator</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Owner Peralatan Excavator') }}
@endpush

@push('page_scripts')
    @include('js.owner.peralatan.excavator.index')
@endpush

