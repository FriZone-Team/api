<?php

namespace Database\Generators;

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
        return $this->faker->randomElement(['MALE', 'FEMALE']);
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
