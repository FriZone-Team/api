<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SystemSettingSeeder::class);
        $this->call(ResourceNamespaceSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SystemUserAttributeSeeder::class);
        $this->call(UserAttributeSeeder::class);
        $this->call(SystemUserGuardSeeder::class);
    }
}
