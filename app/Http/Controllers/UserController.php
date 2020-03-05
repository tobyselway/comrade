<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function search(Request $request)
    {
        return new UserCollection(User::search($request->q)->get());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

}
