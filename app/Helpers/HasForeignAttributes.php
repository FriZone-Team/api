<?php

namespace App\Helpers;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

trait HasForeignAttributes
{
    protected static function getCastes()
    {
        throw new BadMethodCallException();
    }

    public function getForeignAttribute($attribute)
    {
        throw new BadMethodCallException();
    }

    public function setForeignAttribute($attribute, $value)
    {
        throw new BadMethodCallException();
    }

    public static function bootHasForeignAttributes()
    {
        $casts = static::getCastes();
        static::retrieved(function ($instance) use ($casts) {
            $instance->append(array_keys($casts));
            $instance->mergeFillable(array_keys($casts));
            $instance->mergeCasts($casts);
        });
    }

    public function hasAttributeMutator($key)
    {
        return array_search(Str::snake($key), $this->appends) !== false;
    }

    public function hasAttributeSetMutator($key)
    {
        return $this->hasAttributeMutator($key);
    }

    public function getDirty()
    {
        return array_filter(parent::getDirty(), fn ($key) => array_search($key, $this->appends) === false);
    }

    protected function mutateAttributeForArray($key, $value)
    {
        if ($this->isEnumCastable($key)) {
            if (is_null($value) && array_search($key, $this->appends) !== false) {
                try {
                    $value = $this->getForeignAttribute($key);
                } catch (ModelNotFoundException $ex) {
                    $value = null;
                }
            }
            return $this->getEnumCastableAttributeValue($key, $value);
        }
        return parent::mutateAttributeForArray($key, $value);
    }

    public function __call($name, $arguments)
    {
        if (preg_match_all('/^([sg]et)([A-Z][A-Za-z]+)Attribute$/', $name, $matches)) {
            list(, list($action), list($key)) = $matches;
            return call_user_func(call_user_func([$this, Str::lcfirst($key)])->$action);
        }
        if (Str::snake($name) !== $name && array_search(Str::snake($name), $this->appends) !== false) {
            return call_user_func([$this, Str::snake($name)]);
        }
        if (array_search($name, $this->appends) !== false) {
            return Attribute::make(
                get: function () use ($name) {
                    try {
                        return $this->castAttribute($name, $this->getForeignAttribute($name));
                    } catch (ModelNotFoundException $ex) {
                        return null;
                    }
                },
                set: fn ($value) => $this->setForeignAttribute($name, $value),
            );
        }
        return parent::__call($name, $arguments);
    }
}
