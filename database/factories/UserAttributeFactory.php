<?php

namespace Database\Factories;

use Database\Generators\UserGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SystemUserAttribute>
 */
class UserAttributeFactory extends Factory
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

    public function withAttribute($attribute)
    {
        switch ($attribute->key) {
            case 'nickname':
                return $this->state(fn () => ['value' => UserGenerator::nickname()]);
            case 'birthday':
                return $this->state(fn () => ['value' => UserGenerator::birthday()]);
            case 'gender':
                return $this->state(fn () => ['value' => UserGenerator::gender()]);
        }
        return $this;
    }
}
