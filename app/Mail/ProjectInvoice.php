<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class ProjectInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $mailContent;
    public function __construct($data, $subject)
    {
        $this->mailContent = $data;
        $this->subject = $subject;
        $this->from(Auth::guest() ? 'no-reply@agency-system.com' : Auth::user()->email,Auth::guest() ? 'Error' : Auth::user()->name);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.project.invoice',['data'=>$this->mailContent]);
    }
}
