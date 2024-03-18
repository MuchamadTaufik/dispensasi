<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DispensasiReject extends Notification
{
    use Queueable;

    private $dispensasi;
    private $pesanReject;

    /**
     * Create a new notification instance.
     */
    public function __construct($dispensasi, $pesanReject)
    {
        $this->dispensasi = $dispensasi;
        $this->pesanReject = $pesanReject;
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
            'date' => $this->dispensasi->waktu_persetujuan ? $this->dispensasi->waktu_persetujuan->format('Y-m-d H:i:s') : null,
            'title' => 'Dispensasi ' .$this->dispensasi->type->name,
            'name' => $this->dispensasi->user->name,
            'kelas' => $this->dispensasi->user->kelas->name,
            'alasan' => $this->dispensasi->alasan->name ,
            'messages' => 'Ditolak',
            'surat' => $this->pesanReject

        ];
    }
}
