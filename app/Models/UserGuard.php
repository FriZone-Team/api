<?php

namespace App\Models;

class UserGuard extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'guard_id',
        'key',
        'data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id' => 'integer',
        'guard_id' => 'integer',
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
