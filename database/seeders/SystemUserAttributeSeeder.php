<?php

namespace Database\Seeders;

use App\Enums\UserGender;
use App\Models\SystemUserAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemUserAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systemAttributes = [
            'login_failed' => 'integer',
        ];

        $attributes = [
            'nickname' => 'string',
            'birthday' => 'date',
            'gender' => UserGender::class,
        ];

        foreach ($systemAttributes as $key => $cast_type) {
            SystemUserAttribute::factory()->create([
                'key' => $key,
                'cast_type' => $cast_type,
                'is_readonly' => True,
                'is_hidden' => True,
            ]);
        }

        foreach ($attributes as $key => $cast_type) {
            SystemUserAttribute::factory()->create([
                'key' => $key,
                'cast_type' => $cast_type,
                'is_readonly' => False,
                'is_hidden' => False,
            ]);
        }
    }
}
