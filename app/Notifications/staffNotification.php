<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class staffNotification extends Notification
{
    use Queueable;
    public $first_name;
    public $last_name;
    public $limit;
    /**
     * Create a new notification instance.
     */
    public function __construct($limit, $first_name, $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->limit = $limit;
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
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'fname' => $this->first_name,
            'mname' => $this->last_name,
            'limit' => $this->limit,
        ];
    }
}