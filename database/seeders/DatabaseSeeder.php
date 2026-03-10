<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Admin\AdminSettingSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'shakhawat9083@gmail.com',
            'role' => 'admin',
            'password' => Hash::make(time()),
        ]);

        $this->call([
            AdminSettingSeeder::class,
        ]);
    }
}
