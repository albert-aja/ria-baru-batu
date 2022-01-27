@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fas fa-truck-loading fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Muatan</span>
                <span class="info-box-number"></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-warehouse fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Gudang</span>
                <span class="info-box-number">{{ GeneralHelp::get_numeral(0, ($gudang_penambahan - $gudang_pengurangan)) }} Truk</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fas fa-cash-register fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Penjualan Trip</span>
                <span class="info-box-number"></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fas fa-cash-register fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Penjualan Customer</span>
                <span class="info-box-number"></span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumbs')

@endpush

@push('page_scripts')

@endpush

