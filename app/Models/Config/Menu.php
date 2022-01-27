<?php

namespace App\Models\Config;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory, Uuid;

    protected $table = 'config_menu';

    public function get_parent()
    {
        return $this->belongsTo(Menu::class, 'parent');
    }

    public function get_child()
    {
        return $this->hasMany(Menu::class, 'parent')->orderBy('created_at');
    }
}
