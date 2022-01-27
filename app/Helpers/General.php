<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class General
{
    public static function get_level_akses($role = 'kosong')
    {
        $role = ($role == 'kosong' ? Auth::user()->getRoleNames()->first() : $role);

        return $role;
    }

    public static function get_base_url_level_akses()
    {
        $real_role = General::get_level_akses();

        if ($real_role == 'Admin') {
            return route('Admin Beranda');
        } else if ($real_role == 'Operator Excavator') {
            return route('Operator Excavator Beranda');
        } else if ($real_role == 'Sales') {
            return route('Sales Beranda');
        } else if ($real_role == 'Loket') {
            return route('Loket Beranda');
        } else {
            return route('Keluar');
        }
    }

    public static function get_profil_url_level_akses()
    {
        $role = Auth::user()->getRoleNames()->first();

        if ($role == 'Admin') {
            return route('Admin Profil');
        } else if ($role == 'Operator Excavator') {
            return route('Operator Excavator Profil');
        } else if ($role == 'Owner') {
            return route('Owner Profil');
        }
    }

    public static function get_default_show_footer($data, $permission, $edit_url, $destroy_url, $back_url, $destroy_confirm)
    {
        $footer = '
                    <div class="box-footer">
                        ' . ($permission[0] == 1 ? '<a href="' . $edit_url . '" class="btn btn-sm btn-success">Sunting</a>' : '') . '
                        ' . ($permission[1] == 1 ? '<TombolHapus url="' . $destroy_url . '" pertanyaan="' . $destroy_confirm . '" parameter="id" value="' . $data->id . '" class="btn btn-sm btn-danger">Hapus</TombolHapus>' : '') . '
                        ' . ($permission[2] == 1 ? '<a href="' . $back_url . '" class="btn btn-sm btn-default pull-right">Kembali</a>' : '') . '
                    </div>
                  ';
        return $footer;
    }

    public static function get_date_with_format($date, $format)
    {
        return Carbon::parse($date)->translatedFormat($format);
    }

    public static function get_numeral($curency, $value)
    {
        return ($curency == '1' ? 'Rp. ' : '') . '' . number_format($value, 2, ',', '.') . '';
    }

    public static function get_greetings()
    {
        $greetings = "";

        $time = date("H");

        $timezone = date("e");

        if ($time < "12") {
            $greetings = "Selamat Pagi";
        } else

        if ($time >= "12" && $time < "17") {
            $greetings = "Selamat Siang";
        } else

        if ($time >= "17" && $time < "19") {
            $greetings = "Selamat Sore";
        } else

        if ($time >= "19") {
            $greetings = "Selamat Malam";
        }

        return $greetings;
    }
}
