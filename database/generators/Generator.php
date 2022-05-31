<?php

namespace Database\Generators;

use Illuminate\Container\Container;

use Faker\Generator as FakerGenerator;

abstract class Generator
{
    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    protected function withFaker()
    {
        return Container::getInstance()->make(FakerGenerator::class);
    }

    public static function __callStatic($name, $arguments)
    {
        $context = static::getContext(static::class, $name);
        if ($context) {
            return call_user_func_array($context, $arguments);
        }
        return null;
    }
}
