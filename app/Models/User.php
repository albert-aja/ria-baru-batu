<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Uuid, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'tlp',
        'foto',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findForPassport($identifier)
    {
        return User::orWhere('email', $identifier)->where('status', 1)->first();
    }

    public function get_pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'pegawai', 'id');
    }

    public function get_total_utang()
    {
        return $this->get_pinjaman->sum(function ($get_pinjaman) {
            return ($get_pinjaman->get_status->nama == 'Belum Lunas' ? $get_pinjaman->nominal : 0);
        });
    }
}
