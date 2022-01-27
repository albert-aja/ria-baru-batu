<?php

namespace Database\Seeders;

use App\Models\Config\Menu;
use App\Models\Config\Role;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            if ($role->name == 'Admin') {
                Menu::create([
                    'judul' => 'Beranda',
                    'icon' => 'fas fa-home',
                    'link' => 'admin/beranda',
                    'source' => 'Beranda',
                    'role' => $role['id'],
                ]);
                sleep(1);

                $peralatan = Menu::create([
                    'judul' => 'Peralatan',
                    'icon' => 'fas fa-tools',
                    'link' => 'admin/peralatan',
                    'source' => 'Peralatan',
                    'role' => $role['id'],
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Excavator',
                    'icon' => 'fas fa-tractor',
                    'link' => 'excavator',
                    'source' => 'Peralatan\Excavator',
                    'role' => $role['id'],
                    'parent' => $peralatan->id,
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Truk',
                    'icon' => 'fas fa-truck',
                    'link' => 'truk',
                    'source' => 'Peralatan\Truk',
                    'role' => $role['id'],
                    'parent' => $peralatan->id,
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Operasional',
                    'icon' => 'fas fa-file-contract',
                    'link' => 'operasional',
                    'source' => 'Peralatan\Operasional',
                    'role' => $role['id'],
                    'parent' => $peralatan->id,
                ]);
                sleep(1);

                $pegawai = Menu::create([
                    'judul' => 'Kepegawaian',
                    'icon' => 'fas fa-users',
                    'link' => 'admin/kepegawaian',
                    'source' => 'Kepegawaian',
                    'role' => $role['id'],
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Pegawai',
                    'icon' => 'fas fa-users',
                    'link' => 'pegawai',
                    'source' => 'Kepegawaian\Pinjaman',
                    'role' => $role['id'],
                    'parent' => $pegawai->id,
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Pinjaman',
                    'icon' => 'fas fa-money-bill-wave',
                    'link' => 'pinjaman',
                    'source' => 'Kepegawaian\Pinjaman',
                    'role' => $role['id'],
                    'parent' => $pegawai->id,
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Gaji',
                    'icon' => 'fas fa-money-bill',
                    'link' => 'gaji',
                    'source' => 'Kepegawaian\Gaji',
                    'role' => $role['id'],
                    'parent' => $pegawai->id,
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Gudang',
                    'icon' => 'fas fa-warehouse',
                    'link' => 'admin/gudang',
                    'source' => 'Gudang',
                    'role' => $role['id'],
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Muatan',
                    'icon' => 'fas fa-truck-loading',
                    'link' => 'admin/muatan',
                    'source' => 'Muatan',
                    'role' => $role['id'],
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Penjualan',
                    'icon' => 'fas fa-cash-register',
                    'link' => 'admin/penjualan',
                    'source' => 'Penjualan',
                    'role' => $role['id'],
                ]);
                sleep(1);

                Menu::create([
                    'judul' => 'Pengaturan',
                    'icon' => 'fas fa-cogs',
                    'link' => 'admin/pengaturan',
                    'source' => 'Pengaturan',
                    'role' => $role['id'],
                ]);
                sleep(1);
            }
        }
    }
}
