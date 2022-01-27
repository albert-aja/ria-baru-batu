@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-custom"><i class="fas fas fa-tractor fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Excavator</span>
                <span class="info-box-number">1 Unit</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-custom"><i class="fas fa-truck fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Truk</span>
                <span class="info-box-number">1 Unit</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-custom"><i class="fas fa-users fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pegawai</span>
                <span class="info-box-number">1 Orang</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-custom"><i class="fas fa-cash-register fa-xs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pengeluaran Bulan Ini</span>
                <span class="info-box-number"></span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumbs')
    {{ Breadcrumbs::render('Admin Beranda') }}
@endpush

@push('page_scripts')

@endpush

