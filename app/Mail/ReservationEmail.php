<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationEmail extends Mailable
{
    use Queueable, SerializesModels;

    // array with all your data
    protected  $data;
    protected  $setting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $setting)
    {
        $this->data = $data;
        $this->setting = $setting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data->from == "INQUIRY" || $this->data->from == "RSVP MARKETING"){
            return $this->from('noreply@tirtasanitaresort.com', 'Horison Tirta Sanita')
            ->subject($this->data->subject)
            ->view('templates/template_email_marketing')
            ->with('data', $this->data);
        }else if($this->data->from == "ROOMS" || $this->data->from == "PRODUCTS"){
            return $this->from('noreply@tirtasanitaresort.com', 'Horison Tirta Sanita')
            ->subject('Horison Reservation for Booking ID '.$this->data->reservation_id)
            ->view('templates/template_email')
            ->with('data', $this->data)
            ->with('setting', $this->setting)
            ->attachData($this->data->voucher_attachment, 'voucher.pdf', [
                'mime' => 'application/pdf',
            ])
            ->attachData($this->data->receipt_attachment, 'receipt.pdf', [
                'mime' => 'application/pdf',
            ]);
        }
    }


}
