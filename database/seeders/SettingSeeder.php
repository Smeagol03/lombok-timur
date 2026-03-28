<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Creating settings...');

        // Create or update settings
        $setting = Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Portal Lombok Timur',
                'site_tagline' => 'Melayani dengan transparansi dan profesionalisme untuk masyarakat',
                'site_description' => 'Portal resmi Pemerintah Kabupaten Lombok Timur yang menyediakan informasi dan layanan publik secara transparan dan profesional.',
                'meta_title' => 'Portal Resmi Pemerintah Kabupaten Lombok Timur',
                'meta_description' => 'Portal resmi Pemerintah Kabupaten Lombok Timur. Temukan informasi layanan publik, berita terkini, pengumuman, dan destinasi wisata di Lombok Timur, NTB.',
                'meta_keywords' => 'lombok timur, pemerintah lombok timur, layanan publik, ntb, portal resmi, selong',
                'contact_phone' => '(0376) 123456',
                'contact_email' => 'info@lomboktimur.go.id',
                'contact_address' => 'Jl. Pendidikan No. 1, Selong, Kabupaten Lombok Timur, NTB 83612',
                'social_facebook' => 'https://facebook.com/pemkablomboktimur',
                'social_instagram' => 'https://instagram.com/pemkablomboktimur',
                'social_twitter' => 'https://twitter.com/lomboktimur',
                'social_youtube' => 'https://youtube.com/@pemkablomboktimur',
            ]
        );

        // Download and attach demo logo
        $this->command->info('Downloading demo logo...');
        try {
            $logoUrl = 'https://picsum.photos/400/200?random=logo';
            $logoPath = storage_path('app/temp/logo_demo.png');

            Storage::makeDirectory('temp');

            $response = Http::get($logoUrl);
            if ($response->successful()) {
                file_put_contents($logoPath, $response->body());
                $setting->addMedia($logoPath)
                    ->toMediaCollection('logo');
                unlink($logoPath);
                $this->command->info('Demo logo attached successfully.');
            }
        } catch (\Exception $e) {
            $this->command->warn("Could not download demo logo: {$e->getMessage()}");
        }

        // Download and attach demo favicon
        $this->command->info('Downloading demo favicon...');
        try {
            $faviconUrl = 'https://picsum.photos/64/64?random=favicon';
            $faviconPath = storage_path('app/temp/favicon_demo.png');

            $response = Http::get($faviconUrl);
            if ($response->successful()) {
                file_put_contents($faviconPath, $response->body());
                $setting->addMedia($faviconPath)
                    ->toMediaCollection('favicon');
                unlink($faviconPath);
                $this->command->info('Demo favicon attached successfully.');
            }
        } catch (\Exception $e) {
            $this->command->warn("Could not download demo favicon: {$e->getMessage()}");
        }

        // Clean up temp directory
        if (is_dir(storage_path('app/temp'))) {
            rmdir(storage_path('app/temp'));
        }

        $this->command->info('Settings seeded successfully.');
    }
}
