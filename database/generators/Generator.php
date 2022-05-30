<?php

namespace Database\Generators;

use Illuminate\Container\Container;

use Faker\Generator as FakerGenerator;
use Illuminate\Support\Str;
use ReflectionMethod;

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

    protected static function getContext($clazz, $name)
    {
        if (method_exists($clazz, $name)) {
            $method = new ReflectionMethod($clazz, $name);
            if (!$method->isStatic()) {
                return [new $clazz(), $name];
            }
            return [$clazz, $name];
        }
        if (!str_starts_with($name, 'get')) {
            $name = Str::camel(sprintf('get_%s', $name));
            return static::getContext($clazz, $name);
        }
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
