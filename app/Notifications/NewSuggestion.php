<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSuggestion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $suggestion;

    /**
     * Create a new notification instance.
     */
    public function __construct($suggestion)
    {
        $this->suggestion = $suggestion;
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
            'suggestion_id' => $this->suggestion->id,
            'title' => $this->suggestion->title,
            'sender_name' => $this->suggestion->sender->name,
            'message' => \Illuminate\Support\Str::limit($this->suggestion->message, 50),
            'action_url' => '', // We will determine the URL dynamically based on user role or shared route
        ];
    }
}
