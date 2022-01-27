<?php

namespace App\Models\View\Laporan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'v_laporan_pengeluaran';

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];
}
