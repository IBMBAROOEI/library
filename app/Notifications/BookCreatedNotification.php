<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class BookCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        // Constructor logic if needed
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('View Book', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            // Additional data if needed
        ];
    }

    public function failed($exception)
    {
        // Handle the failure, log the exception, etc.
        Log::error('Notification failed: ' . $exception->getMessage());
    }
}
