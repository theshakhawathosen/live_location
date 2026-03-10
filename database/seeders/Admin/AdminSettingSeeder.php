<?php

namespace Database\Seeders\Admin;

use App\Models\AdminSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminSetting::create([
            'maintenance' => false,
            'allow_registration' => true,
        ]);
    }
}
