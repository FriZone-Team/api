<?php

namespace Database\Seeders;

use App\Models\SystemUserAttribute;
use App\Models\User;
use App\Models\UserAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = [
            'login_failed' => .3,
            'nickname' => .9,
            'birthday' => .75,
            'gender' => .75,
        ];

        foreach (User::all() as $user) {
            foreach (SystemUserAttribute::all() as $attribute) {
                $rate = $rates[$attribute->key] ?? .25;
                if (mt_rand() / mt_getrandmax() < $rate) {
                    UserAttribute::factory()->withAttribute($attribute)->create([
                        'user_id' => $user->id,
                        'attribute_id' => $attribute->id,
                    ]);
                }
            }
        }
    }
}
