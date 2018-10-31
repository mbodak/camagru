<?php

DEFINE('ROUTES', array (
    '/home'          => 'camagru/home',
    '/about'         => 'camagru/about',
    '/take-photo'    => 'account/photo',
    '/profile'       => 'account/profile',
    '/sign-up'       => 'account/create',
    '/login'         => 'account/login',
    '/logout'        => 'account/logout',
    '/forgot'        => 'account/forgot',
    '/recover'       => 'account/recover',
    '/change'        => 'account/change',
    '/notifications' => 'account/notifications',
    '/activate'      => 'account/activate',
    '/emailoccupied' => 'account/isEmailOccupied',
    '/logioccupied' => 'account/isLoginOccupied',
    '/savephoto'     => 'image/save',
    '/remove'        => 'image/remove',
    '/like'          => 'image/like',
    '/dislike'       => 'image/dislike',
    '/isliked'       => 'image/isLiked'
));
