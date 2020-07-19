<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('channel-orders', function ($user) {
    return auth()->check();
});

Broadcast::channel('message.orders', function ($post) {


    info("Load  Channel :  message.orders");

    //return (int) auth()->user()->id != (int) $post->user_id;
    return true;
});
