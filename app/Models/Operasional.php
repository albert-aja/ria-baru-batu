<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operasional extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'operasional';
    protected $fillable = ['tgl', 'jenis', 'peralatan', 'pegawai', 'nominal', 'keterangan'];

    public function get_excavator()
    {
        return $this->belongsTo(Excavator::class, 'peralatan');
    }

    public function get_truk()
    {
        return $this->belongsTo(Truk::class, 'peralatan');
    }

    public function get_pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai');
    }
}
