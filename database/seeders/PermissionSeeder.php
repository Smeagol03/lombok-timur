<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $resources = [
            'berita' => 'Berita',
            'kategori' => 'Kategori',
            'agenda' => 'Agenda',
            'pengumuman' => 'Pengumuman',
            'layanan' => 'Layanan',
            'wisata' => 'Wisata',
            'harga-pokok' => 'Harga Pokok',
            'stok-darah' => 'Stok Darah',
            'slider-hero' => 'Slider Hero',
            'link-banner' => 'Link Banner',
        ];

        $actions = ['view', 'view_any', 'create', 'update', 'delete', 'restore', 'force_delete'];

        foreach ($resources as $resource => $label) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(
                    ['name' => "{$action}_{$resource}"],
                    ['guard_name' => 'web']
                );
            }
        }

        $roles = [
            'Super Admin' => 'Full access to all resources',
            'Admin Konten' => 'Manage news, announcements, and agendas',
            'Admin Layanan' => 'Manage services and tourism',
            'Operator Harga' => 'Manage prices and blood stock',
            'Admin Media' => 'Manage media uploads',
        ];

        foreach ($roles as $name => $description) {
            Role::firstOrCreate(
                ['name' => $name],
                ['guard_name' => 'web']
            );
        }

        $superAdminPermissions = Permission::all();
        $superAdmin = Role::where('name', 'Super Admin')->first();
        $superAdmin->syncPermissions($superAdminPermissions);

        $adminKontenPermissions = Permission::whereIn('name', [
            'view_berita', 'view_any_berita', 'create_berita', 'update_berita', 'delete_berita', 'restore_berita',
            'view_kategori', 'view_any_kategori',
            'view_agenda', 'view_any_agenda', 'create_agenda', 'update_agenda', 'delete_agenda',
            'view_pengumuman', 'view_any_pengumuman', 'create_pengumuman', 'update_pengumuman', 'delete_pengumuman', 'restore_pengumuman',
        ])->get();
        Role::where('name', 'Admin Konten')->first()->syncPermissions($adminKontenPermissions);

        $adminLayananPermissions = Permission::whereIn('name', [
            'view_layanan', 'view_any_layanan', 'create_layanan', 'update_layanan', 'delete_layanan',
            'view_wisata', 'view_any_wisata', 'create_wisata', 'update_wisata', 'delete_wisata',
        ])->get();
        Role::where('name', 'Admin Layanan')->first()->syncPermissions($adminLayananPermissions);

        $operatorHargaPermissions = Permission::whereIn('name', [
            'view_harga-pokok', 'view_any_harga-pokok', 'create_harga-pokok', 'update_harga-pokok', 'delete_harga-pokok',
            'view_stok-darah', 'view_any_stok-darah', 'create_stok-darah', 'update_stok-darah', 'delete_stok-darah',
        ])->get();
        Role::where('name', 'Operator Harga')->first()->syncPermissions($operatorHargaPermissions);

        $adminMediaPermissions = Permission::whereIn('name', [
            'view_slider-hero', 'view_any_slider-hero', 'create_slider-hero', 'update_slider-hero', 'delete_slider-hero',
            'view_link-banner', 'view_any_link-banner', 'create_link-banner', 'update_link-banner', 'delete_link-banner',
        ])->get();
        Role::where('name', 'Admin Media')->first()->syncPermissions($adminMediaPermissions);
    }
}
