<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            'app_name' => 'Frizone',
        ];

        foreach ($attributes as $key => $value) {
            SystemSetting::factory()->create([
                'key' => $key,
                'value' => json_encode($value),
            ]);
        }
    }
}
