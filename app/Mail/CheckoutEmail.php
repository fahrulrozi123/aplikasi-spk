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
        return $this->from('noreply@tripasysfo.com', 'Horison Ultima Bandung')
                    ->subject($this->data->subject)
                    ->view('templates/template_checkout')
                    ->with('data', $this->data)
                    ->with('setting', $this->setting);
    }
}
