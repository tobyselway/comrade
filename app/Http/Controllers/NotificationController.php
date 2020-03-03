<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationCollection;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index() {
        $notifications = auth()->user()->notifications;
        return new NotificationCollection($notifications);
    }

}
