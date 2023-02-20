<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailHelper extends Mailable
{
    use Queueable, SerializesModels;
    // custom variable
    public $mailData;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData,$template)
    {
        $this->mailData = $mailData;
        $this->template = $template;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.'.$this->template);
    }
}
