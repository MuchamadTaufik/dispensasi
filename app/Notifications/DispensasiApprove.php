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
        // Check if waktu_persetujuan is not null
        if ($this->dispensasi->waktu_persetujuan) {
            // Set variable date based on type_id
            $date = ($this->dispensasi->type_id === 1) ? $this->dispensasi->waktu_masuk : $this->dispensasi->waktu_keluar;
            
            // Convert $date to DateTime object if it's a string
            if (is_string($date)) {
                $date = new \DateTime($date);
            }
        } else {
            // If waktu_persetujuan is null, set date to null
            $date = null;
        }

        return [
            'date' => $date ? $date->format('Y-m-d H:i:s') : null,
            'title' => $this->dispensasi->type->name,
            'name' => $this->dispensasi->user->name,
            'kelas' => $this->dispensasi->user->kelas->name,
            'alasan' => $this->dispensasi->alasan->name ,
            'messages' => 'Diterima',
            'surat' => '<a href="' . route('download-pdf', $this->dispensasi->id) . '">Download Surat</a>',
        ];
    }
}
