<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'v_gudang_all';

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];
}
