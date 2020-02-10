<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollectionResource;
use App\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        return new PostCollectionResource($user->posts);
    }
}
