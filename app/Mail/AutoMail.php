<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoMail extends Mailable
{
    use Queueable, SerializesModels;
    
    private $avg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($avg)
    {
        $this->avg = $avg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.autoMail')
        ->subject('Thông báo thôi học')
        ->with([
            'avg' => $this->avg,
        ]);
    }
}
