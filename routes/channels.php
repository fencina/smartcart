<?php

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

Broadcast::channel('new-purchase', function ($user) {
    return $user->hasRole(\App\Role::CASHIER) OR $user->hasRole(\App\Role::SUPER_ADMIN);
});

Broadcast::channel('purchase-associated', function ($user) {
    return true;
});
