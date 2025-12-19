<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatsappService
{
    /**
     * Send a WhatsApp message.
     *
     * @param string $to The phone number to send to.
     * @param string $message The message content.
     * @return bool
     */
    public static function send($to, $message)
    {
        // Placeholder for WhatsApp API integration (e.g., Fonnte, Twilio)
        // In a real implementation, you would make an HTTP request here.

        Log::info("WhatsApp Notification sent to {$to}: {$message}");

        return true;
    }
}
