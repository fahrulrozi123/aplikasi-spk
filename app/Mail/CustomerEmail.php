<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerEmail extends Mailable
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
        if($this->data->from == "INQUIRY"){
            return $this->from('noreply@tripasysfo.com', 'Horison Tirta Sanita')
            ->subject($this->data->subject)
            ->view('templates/template_email_customer')
            ->with('data', $this->data)
            ->with('setting', $this->setting);
        }
    }
}
