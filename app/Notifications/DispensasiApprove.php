<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DispensasiApprove extends Notification
{
    use Queueable;

    private $dispensasi;


    /**
     * Create a new notification instance.
     */
    public function __construct($dispensasi)
    {
        $this->dispensasi = $dispensasi;
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
            'user_id' => $this->dispensasi->user->name,
            // 'type_id' => $this->dispensasi->type->name,
            // 'alasan_id' => $this->dispensasi->alasan->name,
            'title' => 'Dispensasi ' .$this->dispensasi->type->name,
            'messages' => $this->dispensasi->user->name . ' Sedang Melakukan Dispensasi, Pada : ' . ($this->dispensasi->waktu_keluar ? $this->dispensasi->waktu_keluar : $this->dispensasi->waktu_masuk) . ' Karena ' . $this->dispensasi->alasan->name,

        ];
    }
}
