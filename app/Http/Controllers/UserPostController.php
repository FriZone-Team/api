<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserPostResource;
use App\Http\Resources\UserPostCollection;
use App\Models\UserPost;
use Illuminate\Http\Request;

class UserPostController extends CRUDController
{
    protected function getModel()
    {
        return UserPost::class;
    }

    protected function getResponse()
    {
        return UserPostResource::class;
    }

    protected function getCollection()
    {
        return UserPostResource::class;
    }
}
