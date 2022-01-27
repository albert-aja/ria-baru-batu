<?php

namespace App\Models;

use App\Models\Ref\PinjamanStatus;
use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'pinjaman';
    protected $fillable = ['pegawai', 'tgl', 'nominal', 'status'];

    public function get_pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai');
    }

    public function get_status()
    {
        return $this->belongsTo(PinjamanStatus::class, 'status');
    }
}
