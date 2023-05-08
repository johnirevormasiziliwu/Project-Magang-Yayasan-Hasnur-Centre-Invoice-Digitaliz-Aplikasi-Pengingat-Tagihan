<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;
    /**
     * Create a new message instance.
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Mailable',
        );
    }

    /**
     * Get the message content definition.
     */
   public function build()
   {
    $subject = "Dear Digitaliz,

    Saya berharap email ini menemukan Anda dalam keadaan sehat dan baik-baik saja. Saya ingin mengingatkan Anda bahwa faktur kami nomor 002/INV-HC/III/2023 berjudul Pembuatan Aplikasi Invoice Digitaliz dengan tanggal jatuh tempo pada tanggal 30 April 2023 masih belum dibayarkan.
    
    Jumlah yang harus dibayarkan adalah Rp. 200.000.000 seperti yang tertera pada faktur. Sesuai dengan persyaratan kontrak kami, pembayaran harus dibuat tepat waktu. Kami telah memberikan layanan kepada Anda dengan sepenuh hati dan kami berharap Anda juga dapat memenuhi kewajiban Anda dalam hal pembayaran. Kami sangat menghargai hubungan bisnis yang baik dengan Anda dan kami berharap dapat terus bekerja sama dengan Anda dalam jangka panjang.
    
    Saya meminta Anda untuk segera membayar faktur ini dalam waktu 10 hari. Jika ada masalah dengan faktur atau informasi tambahan yang dibutuhkan, silakan hubungi kami segera.
    
    Terima kasih atas perhatian Anda pada masalah ini. Saya berharap dapat menerima pembayaran dari Anda segera.
    
    Hormat saya,
    
    
    Yayasan Hasnur Center";
    return $this->subject($subject)
                ->view('admin.email.sendemail');
   }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
