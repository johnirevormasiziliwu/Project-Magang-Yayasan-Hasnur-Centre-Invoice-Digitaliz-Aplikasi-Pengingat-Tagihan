<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaidNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $invoice;
    private $total;
    /**
     * Create a new notification instance.
     */
    public function __construct($invoice, $total)
    {
        $this->invoice = $invoice;
        $this->total = $total;
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
        $invoice = $this->invoice;
        return (new MailMessage)
                    ->line("Dear".$this->invoice->customer->name_unit)
                    ->line("Saya berharap email ini menemukan Anda dalam keadaan sehat dan baik-baik saja. Saya ingin mengingatkan Anda bahwa faktur kami nomor **".$this->invoice->invoice_number."** berjudul **".$this->invoice->title."** dengan tanggal jatuh tempo pada tanggal **".date('d F Y', strtotime($this->invoice->due_date))."** masih belum dibayarkan.")
                    ->line("Jumlah yang harus dibayarkan adalah **".$this->total."** seperti yang tertera pada faktur. Sesuai dengan persyaratan kontrak kami, pembayaran harus dibuat tepat waktu. Kami telah memberikan layanan kepada Anda dengan sepenuh hati dan kami berharap Anda juga dapat memenuhi kewajiban Anda dalam hal pembayaran. Kami sangat menghargai hubungan bisnis yang baik dengan Anda dan kami berharap dapat terus bekerja sama dengan Anda dalam jangka panjang.")
                    ->line("Saya meminta Anda untuk segera membayar faktur ini dalam waktu 10 hari. Jika ada masalah dengan faktur atau informasi tambahan yang dibutuhkan, silakan hubungi kami segera.")
                    ->line("Terima kasih atas perhatian Anda pada masalah ini. Saya berharap dapat menerima pembayaran dari Anda segera.")
                    ->action('Download Invoice', route('download.invoice', ['invoice' => $this->invoice]))
                    ->line("Hormat Kami")
                    ->line('Yayasan Hasnur Center');
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
