<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\ValidationErrorException;
use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use App\Notifications\FriendshipRequested;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FriendRequestController extends Controller
{

    public function store(Request $request) {
        $data = $request->validate([
            'friend_id' => 'required'
        ]);

        try {
            $friend = User::findOrFail($data["friend_id"]);
        } catch(ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }

        $friend->friends()->syncWithoutDetaching(auth()->user());

        $friendship = Friend::where('user_id', auth()->user()->id)
            ->where('friend_id', $data['friend_id'])
            ->first();

        $friend->notify(new FriendshipRequested($friendship));

        return new FriendResource($friendship);
    }

}
