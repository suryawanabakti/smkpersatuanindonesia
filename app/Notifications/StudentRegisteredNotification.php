<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentRegisteredNotification extends Notification
{
    use Queueable;

    protected $siswa;

    /**
     * Create a new notification instance.
     */
    public function __construct($siswa)
    {
        $this->siswa = $siswa;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pendaftaran Siswa Baru - ' . $this->siswa->nama_lengkap)
            ->greeting('Halo Panitia!')
            ->line('Seorang mahasiswa baru telah mendaftar di sistem.')
            ->line('Berikut adalah rincian pendaftar:')
            ->line('Nama Lengkap: ' . $this->siswa->nama_lengkap)
            ->line('Email: ' . $this->siswa->email)
            ->line('Jurusan Pilihan: ' . $this->siswa->jurusan_pilihan)
            ->line('No Pendaftaran: ' . $this->siswa->no_pendaftaran)
            ->action('Lihat Detail Pendaftaran', route('panitia.pendaftaran.show', $this->siswa->id))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pendaftaran_id' => $this->siswa->id,
            'nama_lengkap' => $this->siswa->nama_lengkap,
            'no_pendaftaran' => $this->siswa->no_pendaftaran,
            'jurusan_pilihan' => $this->siswa->jurusan_pilihan,
            'message' => 'Mahasiswa baru telah mendaftar: ' . $this->siswa->nama_lengkap,
            'type' => 'success',
            'log_type' => 'registration',
        ];
    }
}
