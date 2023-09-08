<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Twilio\TwilioSmsMessage;
use Illuminate\Notifications\Messages\MailMessage;

class LoginVerify extends Notification
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
        return [Twiliochanell::class];
    }

    /**
     * Get the Twilio representation of the notification.
     */
    public function totwilio($notifiable)
    {
        $loginCode = rand(11111, 99999);

        $notifiable->update([
            'login_code' => $loginCode
        ]);

        return (new TwilioSmsMessage())
            ->content("Your Login Code is {$loginCode}. Don't share with anyone.");
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
