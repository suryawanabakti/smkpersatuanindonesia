<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivityNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $causer;
    protected $type;
    protected $metadata;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $causer = null, $type = 'info', $metadata = [])
    {
        $this->message = $message;
        $this->causer = $causer;
        $this->type = $type;
        $this->metadata = $metadata;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'causer_name' => $this->causer ? $this->causer->name : 'System',
            'causer_id' => $this->causer ? $this->causer->id : null,
            'type' => $this->type,
            'metadata' => $this->metadata,
            'log_type' => 'activity',
        ];
    }
}
