<?php

namespace App\Http\Controllers;

use App\Exceptions\FriendRequestNotFoundException;
use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use App\Notifications\FriendshipReplied;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FriendRequestResponseController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'status' => 'required'
        ]);

        try {
            $friendRequest = Friend::where('user_id', $data['user_id'])
                ->where('friend_id', auth()->user()->id)
                ->firstOrFail();
        } catch(ModelNotFoundException $e) {
            throw new FriendRequestNotFoundException();
        }

        $friendRequest->update(array_merge($data, [
            'confirmed_at' => now()
        ]));

        $friendRequest->user->notify(new FriendshipReplied($friendRequest, true));

        return new FriendResource($friendRequest);
    }

    public function destroy(Request $request) {
        $data = $request->validate([
            'user_id' => 'required'
        ]);

        try {
            $friendRequest = Friend::where('user_id', $data['user_id'])
                ->where('friend_id', auth()->user()->id)
                ->firstOrFail();
        } catch(ModelNotFoundException $e) {
            throw new FriendRequestNotFoundException();
        }

        $friendRequest->user->notify(new FriendshipReplied($friendRequest, false));
        $friendRequest->delete();

        return response()->json([], 204);
    }

}
