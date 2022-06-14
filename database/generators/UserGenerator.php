<?php

namespace Database\Generators;

use App\Enums\UserGender;

class UserGenerator extends Generator
{
    public function getNickname()
    {
        return $this->faker->firstName();
    }

    public function getBirthday()
    {
        return $this->faker->date();
    }

    public function getGender()
    {
        return $this->faker->randomElement(UserGender::cases());
    }

    public function getLoginFailed()
    {
        return $this->faker->randomDigit();
    }

    public function getPassword()
    {
        return $this->faker->password();
    }

    public function getFacebookId()
    {
        return join(array_map(fn () => $this->faker->randomDigit(), array_fill(0, 16, null)));
    }

    public function getGoogleId()
    {
        return sprintf('g-%s', join(array_map(fn () => $this->faker->randomDigit(), array_fill(0, 16, null))));
    }

    public function getEmail()
    {
        return $this->faker->email();
    }
}
