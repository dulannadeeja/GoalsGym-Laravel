<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClassBookingReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hey ' . $notifiable->name)
            ->subject('Book Your Next Class')
            ->line('We hope you are doing well!')
            ->line('It\'s time to book your next class.')
            ->line('Explore our available classes and choose the one that suits you best.')
            ->action('View Available Classes', url('http://localhost/member/bookings'))
            ->line('If you have any questions or need assistance, feel free to reach out.')
            ->line('Thank you for being a valued member of our community!')
            ->salutation('Best regards, Your '.config('app.name').' Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
