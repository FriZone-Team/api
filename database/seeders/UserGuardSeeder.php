<?php

namespace Database\Seeders;

use App\Models\SystemUserGuard;
use App\Models\User;
use App\Models\UserGuard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserGuardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = [
            'password' => .9,
            'facebook' => .5,
            'google' => .5,
            'email' => .75,
            'authenticator_code' => .25,
        ];

        foreach (User::all() as $user) {
            foreach (SystemUserGuard::all() as $guard) {
                $rate = $rates[$guard->key] ?? .25;
                if (mt_rand() / mt_getrandmax() < $rate) {
                    UserGuard::factory()->withGuard($guard)->create([
                        'user_id' => $user->id,
                        'guard_id' => $guard->id,
                    ]);
                }
            }
        }
    }
}
