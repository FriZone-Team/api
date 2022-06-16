<?php

namespace App\Models;

class UserPost extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'type_id'
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
        'owner_id' => 'integer',
        'type_id' => 'integer',
    ];

    public function owner()
    {
        return $this->hasOne(User::class);
    }

    public function type()
    {
        return $this->hasOne(SystemPostType::class);
    }
}
