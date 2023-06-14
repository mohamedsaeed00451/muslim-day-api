<?php

namespace App\Traits;

use App\Models\DeviceToken;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;

trait NotificationTrait
{
    public function sendNotifications($title, $body, $sound = 'default')
    {
        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => $sound
            ],
        ]);
        $tokens = DeviceToken::all()->pluck('device_token')->toArray();
        return Firebase::messaging()->sendMulticast($message, $tokens);

    }
}
