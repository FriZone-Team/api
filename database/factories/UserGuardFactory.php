<?php

namespace Database\Factories;

use Database\Generators\UserGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SystemUserAttribute>
 */
class UserGuardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function withGuard($guard)
    {
        switch ($guard->key) {
            case 'password':
                return $this->state(fn () => [
                    'data' => json_encode(Hash::make(UserGenerator::password())),
                ]);
            case 'facebook':
                return $this->state(fn () => [
                    'key' => UserGenerator::facebookId(),
                ]);
            case 'google':
                return $this->state(fn () => [
                    'key' => UserGenerator::googleId(),
                ]);
            case 'email':
                return $this->state(fn () => [
                    'key' => UserGenerator::email(),
                ]);
        }
        return $this;
    }
}
