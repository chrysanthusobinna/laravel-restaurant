<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;


    public function __construct($user)
    {
        $this->user = $user;
        $this->subject = config('site.name') . " - Your Password Has Been Changed";   

    }

    public function build()
    {
        return $this->subject($this->subject)->view('emails.password_changed_notification');
    }
}
