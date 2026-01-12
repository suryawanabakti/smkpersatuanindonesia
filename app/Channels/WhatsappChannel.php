<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Services\WhatsappService;

class WhatsappChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! method_exists($notification, 'toWhatsapp')) {
            return;
        }

        $message = $notification->toWhatsapp($notifiable);

        // If toWhatsapp returns a string, send it.
        // If it handles sending itself (which my previous code did), we might not need to do anything here, 
        // but typically the channel handles the sending.
        // Let's refactor: Notification produces the message/payload, Channel sends it.

        // However, my previous notification `toWhatsapp` called `WhatsappService::send` directly.
        // That is technically valid if I don't use a Channel class and just call the method manually, 
        // but for `notify()` to work, I need a channel.

        // Let's assume toWhatsapp returns the message string.
        if (is_string($message)) {
            $phone = $notifiable->routeNotificationFor('whatsapp') ?? $notifiable->phone ?? $notifiable->no_hp;
            if ($phone) {
                WhatsappService::send($phone, $message);
            }
        }
    }
}
