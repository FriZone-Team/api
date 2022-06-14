<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;

class UserController extends CRUDController
{
    protected function getModel()
    {
        return User::class;
    }

    protected function getResponse()
    {
        return UserResource::class;
    }

    protected function getCollection()
    {
        return UserCollection::class;
    }
}
