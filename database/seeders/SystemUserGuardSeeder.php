<?php

namespace Database\Seeders;

use App\Models\SystemUserGuard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemUserGuardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['password', 'facebook', 'google', 'email', 'authenticator_code'] as $key) {
            SystemUserGuard::factory()->create([
                'key' => $key,
            ]);
        }
    }
}
