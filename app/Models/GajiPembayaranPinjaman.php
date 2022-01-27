<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GajiPembayaranPinjaman extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'gaji_pembayaran_pinjaman';
    protected $fillable = ['gaji', 'pinjaman'];

    public function get_pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman');
    }
}
