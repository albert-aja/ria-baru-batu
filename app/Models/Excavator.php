<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excavator extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'excavator';
    protected $fillable = ['operator', 'nama'];

    public function get_operator()
    {
        return $this->belongsTo(User::class, 'operator');
    }
}
