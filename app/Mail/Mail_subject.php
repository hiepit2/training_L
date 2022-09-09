<?php

namespace App\Mail;

use App\Models\Subject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail_subject extends Mailable
{
    use Queueable, SerializesModels;
    private $subjects;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjects)
    {
        $this->subjects = $subjects;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail_subject')
        ->subject('Thông báo đăng ký môn học')
        ->with([
            'subjects' => $this->subjects,
        ]);
    }
}
