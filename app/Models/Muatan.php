<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Muatan extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'muatan';
    protected $fillable = ['tgl', 'operator', 'bongkar_muat', 'supir', 'kuantitas', 'gaji'];

    public function get_operator()
    {
        return $this->belongsTo(User::class, 'operator');
    }

    public function get_supir()
    {
        return $this->belongsTo(User::class, 'supir');
    }
}
