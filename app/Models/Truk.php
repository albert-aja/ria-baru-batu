<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truk extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'truk';
    protected $fillable = ['supir', 'nama', 'no_plat'];

    public function get_supir()
    {
        return $this->belongsTo(User::class, 'supir');
    }
}
