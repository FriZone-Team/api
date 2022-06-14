<?php

namespace App\Models;

class UserAttribute extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'attribute_id',
        'value',
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
    protected $casts = [
        'user_id' => 'integer',
        'attribute_id' => 'integer',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function attribute()
    {
        return $this->hasOne(SystemUserAttribute::class);
    }
}
