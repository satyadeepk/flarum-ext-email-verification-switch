<?php

use Flarum\User\Event\Registered;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->listen(Registered::class, function (Registered $event) {
        $user = $event->user;
        $loginProviders = $user->loginProviders;
        //If the user signed up through any login provider, activate automatically without email verification
        if(!empty($loginProviders) && sizeof($loginProviders) > 0){
            $user->activate();
            $user->save();
        }
    });
};
