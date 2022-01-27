<?php

namespace App\Models;

use App\Models\Ref\Asal;
use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanTrip extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'penjualan_trip';
    protected $fillable = ['tgl', 'asal', 'supir', 'truk', 'tonase', 'harga_tonase', 'uang_jalan'];

    public function get_asal()
    {
        return $this->belongsTo(Asal::class, 'asal');
    }

    public function get_supir()
    {
        return $this->belongsTo(User::class, 'supir');
    }

    public function get_truk()
    {
        return $this->belongsTo(Truk::class, 'truk');
    }
}
