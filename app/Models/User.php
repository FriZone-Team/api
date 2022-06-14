<?php

namespace App\Models;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, ModelAttribute, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'avatar_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function attributes()
    {
        return $this->hasMany(UserAttribute::class);
    }

    public static function getCastes()
    {
        $attributes = SystemUserAttribute::whereIsHidden(false)->get()->all();
        $keys = array_map(fn ($item) => $item->key, $attributes);
        return array_combine($keys, array_map(fn ($item) => $item->cast_type, $attributes));
    }

    public function getForeignAttribute($attributeKey)
    {
        $attribute = SystemUserAttribute::whereKey($attributeKey)->firstOrFail();
        if ($attribute->is_hidden) {
            throw new BadMethodCallException();
        }
        return $this->attributes()->whereAttributeId($attribute->id)->firstOrFail()->value;
    }

    public function setForeignAttribute($attributeKey, $value)
    {
        $attribute = SystemUserAttribute::whereKey($attributeKey)->firstOrFail();
        if ($attribute->is_hidden || $attribute->is_readonly) {
            throw new BadMethodCallException();
        }
        return $this->attributes()->firstOrNew(['attribute_id' => $attribute->id])->fill(['value' => $value])->save();
    }
}
