<?php

namespace Database\Seeders;

use App\Models\ResourceNamespace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceNamespaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['avatars', 'photos'] as $key) {
            ResourceNamespace::factory()->create([
                'key' => $key,
            ]);
        }
    }
}
