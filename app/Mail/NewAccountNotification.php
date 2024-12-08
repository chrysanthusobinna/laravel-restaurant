<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAccountNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    public $subject;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
        $this->subject = config('site.name') . " - New Account";   
    }

    public function build()
    {
        return $this->subject($this->subject)->view('emails.new_account_notification');
    }
}
