<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckoutEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected  $data;
    protected  $setting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $payment, $setting)
    {
        $this->data    = $data;
        $this->payment = $payment;
        $this->setting = $setting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = config('email.emailAddress');
        $subject = config('email.emailSubject');

        return $this->from($address, $subject)
                    ->subject($this->data->subject)
                    ->view('templates/template_checkout')
                    ->with('data', $this->data)
                    ->with('payment', $this->payment)
                    ->with('setting', $this->setting);
    }
}
