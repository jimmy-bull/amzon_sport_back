<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Users_Profile_Photo;
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
// App.Models.User.{id}  //  $user, $id


Broadcast::channel('privatemessage.{id}', function (User $user, int $id) {
    return $user->id === $id;
});
Broadcast::channel('setmessagesstate.{id}', function (User $user, int $id) {
    return $user->id === $id;
});
Broadcast::channel('global', function (User $user) {
    return [
        'id' => $user->id,
        'name' => $user->name . ' ' . $user->lastname,
        "speudo" => $user->speudo,
        "connected" => 'yes',
        'email' => $user->email,
        'image' => Users_Profile_Photo::where('email', "=", $user->email)->pluck('image'),
    ];
});
