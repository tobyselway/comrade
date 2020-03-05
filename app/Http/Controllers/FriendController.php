<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;

class FriendController extends Controller
{

    public function index() {
        // TODO: Optimize this method
        $friends = collect();
        foreach(Friend::friendships() as $friendship) {
            if($friendship->user_id == auth()->user()->id) {
                $friend = $friendship->friend;
            } else {
                $friend = $friendship->user;
            }
            $friends->push($friend);
        }
        return new UserCollection($friends);
    }

}
