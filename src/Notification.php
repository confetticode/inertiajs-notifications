<?php

namespace ConfettiCode\Inertiajs\Notifications;

class Notification
{
    public function make(): Message
    {
        return new Message(request());
    }
}
