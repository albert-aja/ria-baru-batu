<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gaji extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'gaji';
    protected $fillable = ['pegawai', 'tahun', 'bulan', 'nominal'];

    public function get_pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai');
    }

    public function get_pembayaran_pinjaman()
    {
        return $this->hasMany(GajiPembayaranPinjaman::class, 'gaji', 'id');
    }

    public function get_total_pembayaran_pinjaman()
    {
        return $this->get_pembayaran_pinjaman->sum(function ($get_pembayaran_pinjaman) {
            return $get_pembayaran_pinjaman->get_pinjaman->nominal;
        });
    }

    public function get_pekerjaan_pengiriman()
    {
        return PenjualanTrip::where('supir', $this->pegawai)->where('tgl', 'LIKE', $this->periode . '%')->get();
    }

    public function get_pekerjaan_muatan()
    {
        return Muatan::where('operator', $this->pegawai)->where('tgl', 'LIKE', $this->periode . '%')->get();
    }
}
