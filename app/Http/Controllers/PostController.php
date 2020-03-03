<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $friends = Friend::friendships();

        if($friends->isEmpty()) {
            return new PostCollection($request->user()->posts);
        }

        return new PostCollection(
            Post::whereIn('user_id', [
                $friends->pluck('user_id'),
                $friends->pluck('friend_id')
            ])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => 'required',
            'image' => '',
            'width' => '',
            'height' => ''
        ]);

        $image = null;

        if(isset($data['image'])) {
            Storage::makeDirectory('public/post-images');
            $image = 'storage/' . $data['image']->store('post-images', 'public');
            Image::make($data['image'])
                ->fit($data['width'], $data['height'])
                ->save(storage_path('app/public/post-images/' . $data['image']->hashName()));
        }

        $post = $request->user()->posts()->create([
            'body' => $data['body'],
            'image' => $image
        ]);

        return new PostResource($post);
    }

}
