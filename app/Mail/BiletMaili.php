<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;


class BiletMaili extends Mailable
{
    public $siparis;

    public function __construct($siparis)
    {
        $this->siparis = $siparis;
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.siparis', ['siparis' => $this->siparis]);

        return $this->subject('🎫 Siparişiniz Onaylandı')
                    ->view('emails.bilet')
                    ->attachData($pdf->output(), 'bilet.pdf');
    }
}
#kullanıcıya giden mail sistemi.