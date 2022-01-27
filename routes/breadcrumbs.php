<?php

use App\Models\Config\Menu;
use App\Models\Excavator;
use App\Models\Gaji;
use App\Models\Muatan;
use App\Models\Operasional;
use App\Models\PenjualanCustomer;
use App\Models\PenjualanTrip;
use App\Models\Pinjaman;
use App\Models\Truk;
use App\Models\User;
use App\Models\View\Gudang;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;

// Admin //
// Beranda
Breadcrumbs::for('Admin Beranda', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Beranda'],
    ])->first();
    $trail->push($menu->judul, route('Admin Beranda'), ['icon' => $menu->icon]);
});

// Profil
Breadcrumbs::for('Admin Profil', function ($trail) {
    $trail->push('Profil', route('Admin Profil'), ['icon' => 'far fa-user']);
});

Breadcrumbs::for('Admin Profil Edit', function ($trail) {
    $trail->parent('Admin Profil');
    $trail->push('Sunting Data', route('Admin Profil Edit'), ['icon' => '']);
});

// Peralatan
Breadcrumbs::for('Admin Peralatan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Peralatan'],
    ])->first();
    $trail->push($menu->judul, '', ['icon' => $menu->icon]);
});

// Excavator
Breadcrumbs::for('Admin Peralatan Excavator', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Peralatan\Excavator'],
    ])->first();
    $trail->parent('Admin Peralatan');
    $trail->push($menu->judul, route('Admin Peralatan Excavator'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Peralatan Excavator Create', function ($trail) {
    $trail->parent('Admin Peralatan Excavator');
    $trail->push('Tambah Data', route('Admin Peralatan Excavator Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Peralatan Excavator Show', function ($trail, $id) {
    $data = Excavator::findOrFail($id);
    $trail->parent('Admin Peralatan Excavator');
    $trail->push($data->nama, route('Admin Peralatan Excavator Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Peralatan Excavator Edit', function ($trail, $id) {
    $data = Excavator::findOrFail($id);
    $trail->parent('Admin Peralatan Excavator Show', $data->id);
    $trail->push('Sunting Data', route('Admin Peralatan Excavator Edit', $data), ['icon' => '']);
});

// Truk
Breadcrumbs::for('Admin Peralatan Truk', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Peralatan\Truk'],
    ])->first();
    $trail->parent('Admin Peralatan');
    $trail->push($menu->judul, route('Admin Peralatan Truk'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Peralatan Truk Create', function ($trail) {
    $trail->parent('Admin Peralatan Truk');
    $trail->push('Tambah Data', route('Admin Peralatan Truk Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Peralatan Truk Show', function ($trail, $id) {
    $data = Truk::findOrFail($id);
    $trail->parent('Admin Peralatan Truk');
    $trail->push($data->nama . ' (' . $data->no_plat . ')', route('Admin Peralatan Truk Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Peralatan Truk Edit', function ($trail, $id) {
    $data = Truk::findOrFail($id);
    $trail->parent('Admin Peralatan Truk Show', $data->id);
    $trail->push('Sunting Data', route('Admin Peralatan Truk Edit', $data), ['icon' => '']);
});

// Operasional
Breadcrumbs::for('Admin Peralatan Operasional', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Peralatan\Operasional'],
    ])->first();
    $trail->parent('Admin Peralatan');
    $trail->push($menu->judul, route('Admin Peralatan Operasional'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Peralatan Operasional Create', function ($trail) {
    $trail->parent('Admin Peralatan Operasional');
    $trail->push('Tambah Data', route('Admin Peralatan Operasional Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Peralatan Operasional Show', function ($trail, $id) {
    $data = Operasional::findOrFail($id);
    $trail->parent('Admin Peralatan Operasional');
    $trail->push(Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ' (' . $data->get_pegawai->name . ')', route('Admin Peralatan Operasional Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Peralatan Operasional Edit', function ($trail, $id) {
    $data = Operasional::findOrFail($id);
    $trail->parent('Admin Peralatan Operasional Show', $data->id);
    $trail->push('Sunting Data', route('Admin Peralatan Operasional Edit', $data), ['icon' => '']);
});

// Kepegawaian
Breadcrumbs::for('Admin Kepegawaian', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Kepegawaian'],
    ])->first();
    $trail->push($menu->judul, '', ['icon' => $menu->icon]);
});

// Kepegawaian Pegawai
Breadcrumbs::for('Admin Kepegawaian Pegawai', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Kepegawaian\Pegawai'],
    ])->first();
    $trail->parent('Admin Kepegawaian');
    $trail->push($menu->judul, route('Admin Kepegawaian Pegawai'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Kepegawaian Pegawai Create', function ($trail) {
    $trail->parent('Admin Kepegawaian Pegawai');
    $trail->push('Tambah Data', route('Admin Kepegawaian Pegawai Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Kepegawaian Pegawai Show', function ($trail, $id) {
    $data = User::findOrFail($id);
    $trail->parent('Admin Kepegawaian Pegawai');
    $trail->push($data->name, route('Admin Kepegawaian Pegawai Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Kepegawaian Pegawai Edit', function ($trail, $id) {
    $data = User::findOrFail($id);
    $trail->parent('Admin Kepegawaian Pegawai Show', $data->id);
    $trail->push('Sunting Data', route('Admin Kepegawaian Pegawai Edit', $data), ['icon' => '']);
});

// Kepegawaian Pinjaman
Breadcrumbs::for('Admin Kepegawaian Pinjaman', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Kepegawaian\Pinjaman'],
    ])->first();
    $trail->parent('Admin Kepegawaian');
    $trail->push($menu->judul, route('Admin Kepegawaian Pinjaman'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Kepegawaian Pinjaman Create', function ($trail) {
    $trail->parent('Admin Kepegawaian Pinjaman');
    $trail->push('Tambah Data', route('Admin Kepegawaian Pinjaman Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Kepegawaian Pinjaman Show', function ($trail, $id) {
    $data = Pinjaman::findOrFail($id);
    $trail->parent('Admin Kepegawaian Pinjaman');
    $trail->push($data->get_pegawai->name . '. ' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y'), route('Admin Kepegawaian Pinjaman Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Kepegawaian Pinjaman Edit', function ($trail, $id) {
    $data = Pinjaman::findOrFail($id);
    $trail->parent('Admin Kepegawaian Pinjaman Show', $data->id);
    $trail->push('Sunting Data', route('Admin Kepegawaian Pinjaman Edit', $data), ['icon' => '']);
});

// Kepegawaian Gaji
Breadcrumbs::for('Admin Kepegawaian Gaji', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Kepegawaian\Gaji'],
    ])->first();
    $trail->parent('Admin Kepegawaian');
    $trail->push($menu->judul, route('Admin Kepegawaian Gaji'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Kepegawaian Gaji Create', function ($trail) {
    $trail->parent('Admin Kepegawaian Gaji');
    $trail->push('Tambah Data', route('Admin Kepegawaian Gaji Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Kepegawaian Gaji Show', function ($trail, $id) {
    $data = Gaji::findOrFail($id);
    $trail->parent('Admin Kepegawaian Gaji');
    $trail->push($data->get_pegawai->name . ' (' . Carbon::parse($data->tahun . '-' . $data->bulan)->isoFormat('MMMM Y') . ')', route('Admin Kepegawaian Gaji Show', $data), ['icon' => '']);
});

// Gudang
Breadcrumbs::for('Admin Gudang', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Gudang'],
    ])->first();
    $trail->push($menu->judul, route('Admin Gudang'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Gudang Show', function ($trail, $id) {
    $data = Gudang::findOrFail($id);
    $trail->parent('Admin Gudang');
    $trail->push($data->judul . ' (' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ')', route('Admin Gudang Show', $data), ['icon' => '']);
});

// Muatan
Breadcrumbs::for('Admin Muatan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Muatan'],
    ])->first();
    $trail->push($menu->judul, route('Admin Muatan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Muatan Create', function ($trail) {
    $trail->parent('Admin Muatan');
    $trail->push('Tambah Data', route('Admin Muatan Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Muatan Show', function ($trail, $id) {
    $data = Muatan::findOrFail($id);
    $trail->parent('Admin Muatan');
    $trail->push($data->get_operator->name . '. ' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y'), route('Admin Muatan Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Muatan Edit', function ($trail, $id) {
    $data = Muatan::findOrFail($id);
    $trail->parent('Admin Muatan Show', $data->id);
    $trail->push('Sunting Data', route('Admin Muatan Edit', $data), ['icon' => '']);
});

// Penjualan
Breadcrumbs::for('Admin Penjualan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Penjualan'],
    ])->first();
    $trail->push($menu->judul, '', ['icon' => $menu->icon]);
});

// Penjualan Trip
Breadcrumbs::for('Admin Penjualan Trip', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Penjualan\Trip'],
    ])->first();
    $trail->parent('Admin Penjualan');
    $trail->push($menu->judul, route('Admin Penjualan Trip'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Penjualan Trip Create', function ($trail) {
    $trail->parent('Admin Penjualan Trip');
    $trail->push('Tambah Data', route('Admin Penjualan Trip Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Trip Show', function ($trail, $id) {
    $data = PenjualanTrip::findOrFail($id);
    $trail->parent('Admin Penjualan Trip');
    $trail->push($data->get_supir->name . ' (' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ')', route('Admin Penjualan Trip Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Trip Edit', function ($trail, $id) {
    $data = PenjualanTrip::findOrFail($id);
    $trail->parent('Admin Penjualan Trip Show', $data->id);
    $trail->push('Sunting Data', route('Admin Penjualan Trip Edit', $data), ['icon' => '']);
});

// Penjualan Customer
Breadcrumbs::for('Admin Penjualan Customer', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Penjualan\Customer'],
    ])->first();
    $trail->parent('Admin Penjualan');
    $trail->push($menu->judul, route('Admin Penjualan Customer'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Admin Penjualan Customer Create', function ($trail) {
    $trail->parent('Admin Penjualan Customer');
    $trail->push('Tambah Data', route('Admin Penjualan Customer Create'), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Customer Show', function ($trail, $id) {
    $data = PenjualanCustomer::findOrFail($id);
    $trail->parent('Admin Penjualan Customer');
    $trail->push($data->customer . ' (' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ')', route('Admin Penjualan Customer Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Admin Penjualan Customer Edit', function ($trail, $id) {
    $data = PenjualanCustomer::findOrFail($id);
    $trail->parent('Admin Penjualan Customer Show', $data->id);
    $trail->push('Sunting Data', route('Admin Penjualan Customer Edit', $data), ['icon' => '']);
});

// Owner //
// Beranda
Breadcrumbs::for('Owner Beranda', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Beranda'],
    ])->first();
    $trail->push($menu->judul, route('Owner Beranda'), ['icon' => $menu->icon]);
});

// Profil
Breadcrumbs::for('Owner Profil', function ($trail) {
    $trail->push('Profil', route('Owner Profil'), ['icon' => 'far fa-user']);
});

Breadcrumbs::for('Owner Profil Edit', function ($trail) {
    $trail->parent('Owner Profil');
    $trail->push('Sunting Data', route('Owner Profil Edit'), ['icon' => '']);
});

// Peralatan
Breadcrumbs::for('Owner Peralatan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Peralatan'],
    ])->first();
    $trail->push($menu->judul, '', ['icon' => $menu->icon]);
});

// Excavator
Breadcrumbs::for('Owner Peralatan Excavator', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Peralatan\Excavator'],
    ])->first();
    $trail->parent('Owner Peralatan');
    $trail->push($menu->judul, route('Owner Peralatan Excavator'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Peralatan Excavator Create', function ($trail) {
    $trail->parent('Owner Peralatan Excavator');
    $trail->push('Tambah Data', route('Owner Peralatan Excavator Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Peralatan Excavator Show', function ($trail, $id) {
    $data = Excavator::findOrFail($id);
    $trail->parent('Owner Peralatan Excavator');
    $trail->push($data->nama, route('Owner Peralatan Excavator Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Peralatan Excavator Edit', function ($trail, $id) {
    $data = Excavator::findOrFail($id);
    $trail->parent('Owner Peralatan Excavator Show', $data->id);
    $trail->push('Sunting Data', route('Owner Peralatan Excavator Edit', $data), ['icon' => '']);
});

// Truk
Breadcrumbs::for('Owner Peralatan Truk', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Peralatan\Truk'],
    ])->first();
    $trail->parent('Owner Peralatan');
    $trail->push($menu->judul, route('Owner Peralatan Truk'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Peralatan Truk Create', function ($trail) {
    $trail->parent('Owner Peralatan Truk');
    $trail->push('Tambah Data', route('Owner Peralatan Truk Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Peralatan Truk Show', function ($trail, $id) {
    $data = Truk::findOrFail($id);
    $trail->parent('Owner Peralatan Truk');
    $trail->push($data->nama . ' (' . $data->no_plat . ')', route('Owner Peralatan Truk Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Peralatan Truk Edit', function ($trail, $id) {
    $data = Truk::findOrFail($id);
    $trail->parent('Owner Peralatan Truk Show', $data->id);
    $trail->push('Sunting Data', route('Owner Peralatan Truk Edit', $data), ['icon' => '']);
});

// Operasional
Breadcrumbs::for('Owner Peralatan Operasional', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Peralatan\Operasional'],
    ])->first();
    $trail->parent('Owner Peralatan');
    $trail->push($menu->judul, route('Owner Peralatan Operasional'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Peralatan Operasional Create', function ($trail) {
    $trail->parent('Owner Peralatan Operasional');
    $trail->push('Tambah Data', route('Owner Peralatan Operasional Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Peralatan Operasional Show', function ($trail, $id) {
    $data = Operasional::findOrFail($id);
    $trail->parent('Owner Peralatan Operasional');
    $trail->push(Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ' (' . $data->get_pegawai->name . ')', route('Owner Peralatan Operasional Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Peralatan Operasional Edit', function ($trail, $id) {
    $data = Operasional::findOrFail($id);
    $trail->parent('Owner Peralatan Operasional Show', $data->id);
    $trail->push('Sunting Data', route('Owner Peralatan Operasional Edit', $data), ['icon' => '']);
});

// Kepegawaian
Breadcrumbs::for('Owner Kepegawaian', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Kepegawaian'],
    ])->first();
    $trail->push($menu->judul, '', ['icon' => $menu->icon]);
});

// Kepegawaian Pegawai
Breadcrumbs::for('Owner Kepegawaian Pegawai', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Kepegawaian\Pegawai'],
    ])->first();
    $trail->parent('Owner Kepegawaian');
    $trail->push($menu->judul, route('Owner Kepegawaian Pegawai'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Kepegawaian Pegawai Create', function ($trail) {
    $trail->parent('Owner Kepegawaian Pegawai');
    $trail->push('Tambah Data', route('Owner Kepegawaian Pegawai Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Kepegawaian Pegawai Show', function ($trail, $id) {
    $data = User::findOrFail($id);
    $trail->parent('Owner Kepegawaian Pegawai');
    $trail->push($data->name, route('Owner Kepegawaian Pegawai Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Kepegawaian Pegawai Edit', function ($trail, $id) {
    $data = User::findOrFail($id);
    $trail->parent('Owner Kepegawaian Pegawai Show', $data->id);
    $trail->push('Sunting Data', route('Owner Kepegawaian Pegawai Edit', $data), ['icon' => '']);
});

// Kepegawaian Pinjaman
Breadcrumbs::for('Owner Kepegawaian Pinjaman', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Kepegawaian\Pinjaman'],
    ])->first();
    $trail->parent('Owner Kepegawaian');
    $trail->push($menu->judul, route('Owner Kepegawaian Pinjaman'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Kepegawaian Pinjaman Create', function ($trail) {
    $trail->parent('Owner Kepegawaian Pinjaman');
    $trail->push('Tambah Data', route('Owner Kepegawaian Pinjaman Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Kepegawaian Pinjaman Show', function ($trail, $id) {
    $data = Pinjaman::findOrFail($id);
    $trail->parent('Owner Kepegawaian Pinjaman');
    $trail->push($data->get_pegawai->name . '. ' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y'), route('Owner Kepegawaian Pinjaman Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Kepegawaian Pinjaman Edit', function ($trail, $id) {
    $data = Pinjaman::findOrFail($id);
    $trail->parent('Owner Kepegawaian Pinjaman Show', $data->id);
    $trail->push('Sunting Data', route('Owner Kepegawaian Pinjaman Edit', $data), ['icon' => '']);
});

// Kepegawaian Gaji
Breadcrumbs::for('Owner Kepegawaian Gaji', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Kepegawaian\Gaji'],
    ])->first();
    $trail->parent('Owner Kepegawaian');
    $trail->push($menu->judul, route('Owner Kepegawaian Gaji'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Kepegawaian Gaji Create', function ($trail) {
    $trail->parent('Owner Kepegawaian Gaji');
    $trail->push('Tambah Data', route('Owner Kepegawaian Gaji Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Kepegawaian Gaji Show', function ($trail, $id) {
    $data = Gaji::findOrFail($id);
    $trail->parent('Owner Kepegawaian Gaji');
    $trail->push($data->get_pegawai->name . ' (' . Carbon::parse($data->tahun . '-' . $data->bulan)->isoFormat('MMMM Y') . ')', route('Owner Kepegawaian Gaji Show', $data), ['icon' => '']);
});

// Gudang
Breadcrumbs::for('Owner Gudang', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Gudang'],
    ])->first();
    $trail->push($menu->judul, route('Owner Gudang'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Gudang Show', function ($trail, $id) {
    $data = Gudang::findOrFail($id);
    $trail->parent('Owner Gudang');
    $trail->push($data->judul . ' (' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ')', route('Owner Gudang Show', $data), ['icon' => '']);
});

// Muatan
Breadcrumbs::for('Owner Muatan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Muatan'],
    ])->first();
    $trail->push($menu->judul, route('Owner Muatan'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Muatan Create', function ($trail) {
    $trail->parent('Owner Muatan');
    $trail->push('Tambah Data', route('Owner Muatan Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Muatan Show', function ($trail, $id) {
    $data = Muatan::findOrFail($id);
    $trail->parent('Owner Muatan');
    $trail->push($data->get_operator->name . '. ' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y'), route('Owner Muatan Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Muatan Edit', function ($trail, $id) {
    $data = Muatan::findOrFail($id);
    $trail->parent('Owner Muatan Show', $data->id);
    $trail->push('Sunting Data', route('Owner Muatan Edit', $data), ['icon' => '']);
});

// Penjualan
Breadcrumbs::for('Owner Penjualan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Penjualan'],
    ])->first();
    $trail->push($menu->judul, '', ['icon' => $menu->icon]);
});

// Penjualan Trip
Breadcrumbs::for('Owner Penjualan Trip', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Penjualan\Trip'],
    ])->first();
    $trail->parent('Owner Penjualan');
    $trail->push($menu->judul, route('Owner Penjualan Trip'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Penjualan Trip Create', function ($trail) {
    $trail->parent('Owner Penjualan Trip');
    $trail->push('Tambah Data', route('Owner Penjualan Trip Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Trip Show', function ($trail, $id) {
    $data = PenjualanTrip::findOrFail($id);
    $trail->parent('Owner Penjualan Trip');
    $trail->push($data->get_supir->name . ' (' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ')', route('Owner Penjualan Trip Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Trip Edit', function ($trail, $id) {
    $data = PenjualanTrip::findOrFail($id);
    $trail->parent('Owner Penjualan Trip Show', $data->id);
    $trail->push('Sunting Data', route('Owner Penjualan Trip Edit', $data), ['icon' => '']);
});

// Penjualan Customer
Breadcrumbs::for('Owner Penjualan Customer', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Penjualan\Customer'],
    ])->first();
    $trail->parent('Owner Penjualan');
    $trail->push($menu->judul, route('Owner Penjualan Customer'), ['icon' => $menu->icon]);
});

Breadcrumbs::for('Owner Penjualan Customer Create', function ($trail) {
    $trail->parent('Owner Penjualan Customer');
    $trail->push('Tambah Data', route('Owner Penjualan Customer Create'), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Customer Show', function ($trail, $id) {
    $data = PenjualanCustomer::findOrFail($id);
    $trail->parent('Owner Penjualan Customer');
    $trail->push($data->customer . ' (' . Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') . ')', route('Owner Penjualan Customer Show', $data), ['icon' => '']);
});

Breadcrumbs::for('Owner Penjualan Customer Edit', function ($trail, $id) {
    $data = PenjualanCustomer::findOrFail($id);
    $trail->parent('Owner Penjualan Customer Show', $data->id);
    $trail->push('Sunting Data', route('Owner Penjualan Customer Edit', $data), ['icon' => '']);
});

// Laporan
Breadcrumbs::for('Owner Laporan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['judul', 'Laporan'],
    ])->first();
    $trail->push($menu->judul, '', ['icon' => $menu->icon]);
});

// Pemasukan
Breadcrumbs::for('Owner Laporan Pemasukan', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Laporan\Pemasukan'],
    ])->first();
    $trail->parent('Owner Laporan');
    $trail->push($menu->judul, route('Owner Laporan Pemasukan'), ['icon' => $menu->icon]);
});

// Pengeluaran
Breadcrumbs::for('Owner Laporan Pengeluaran', function ($trail) {
    $menu = Menu::where([
        ['role', Auth::user()->getRoleId()],
        ['source', 'Laporan\Pengeluaran'],
    ])->first();
    $trail->parent('Owner Laporan');
    $trail->push($menu->judul, route('Owner Laporan Pengeluaran'), ['icon' => $menu->icon]);
});
