<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->group(function() {

    Route::get('auth-user', 'AuthUserController@show');

    Route::apiResources([
        '/posts' => 'PostController',
        '/posts/{post}/vote' => 'PostVoteController',
        '/posts/{post}/comment' => 'PostCommentController',
        '/users' => 'UserController',
        '/users/{user}/posts' => 'UserPostController',
        '/friend-request' => 'FriendRequestController',
        '/friend-request-response' => 'FriendRequestResponseController',
        '/user-images' => 'UserImageController',
        '/notifications' => 'NotificationController'
    ]);

    Route::post('/users/search', 'UserController@search');

});
