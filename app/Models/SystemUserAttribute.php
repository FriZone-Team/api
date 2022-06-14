<?php

namespace App\Models;

class SystemUserAttribute extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'cast_type',
        'is_readonly',
        'is_hidden',
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
        'is_readonly' => 'boolean',
        'is_hidden' => 'boolean',
    ];
}
