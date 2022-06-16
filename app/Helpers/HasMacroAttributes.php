<?php

namespace App\Helpers;

use Illuminate\Support\Str;

trait HasMacroAttributes
{
    public static function __callStatic($name, $arguments)
    {
        foreach (['where', 'firstOrNew'] as $action) {
            if (preg_match_all(sprintf('/^%s([A-Z][A-Za-z]+)$/', $action), $name, $matches)) {
                list(, list($attribute)) = $matches;
                $attribute = Str::snake(Str::lcfirst($attribute));
                if (array_search($attribute, (new static)->getFillable()) !== false) {
                    return call_user_func([static::class, $action], $attribute, ...$arguments);
                }
            }
        }
        return parent::__callStatic($name, $arguments);
    }
}
