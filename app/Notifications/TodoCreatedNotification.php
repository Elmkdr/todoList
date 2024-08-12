<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Todo;

class TodoCreatedNotification extends Notification
{
    use Queueable;

    public $subject,$message,$actionText,$actionUrl;

    public function __construct($record)
    {
        $this->subject = 'Sie haben eine Frage erhalten: ';
        $this->message = 'Frage: "'. '" für die Anfrage #'  . ' erhalten.';
        $this->actionText = 'Anfrage ansehen';
        $this->actionUrl = route('/todos', $record->todo->id);
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail(object $notifiable)
    {
        return (new MailMessage)
            ->line('hallo')
            ->line('hola');
    }
}
