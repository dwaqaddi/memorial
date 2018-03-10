<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $newPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, String $password)
    {
        $this->user = $user;
        $this->newPassword = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.resetPassword');
    }
}
