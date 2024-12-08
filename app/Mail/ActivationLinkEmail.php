<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationLinkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    // Pass both user and token to the constructor
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        // Generate the activation link using the token
        $activationLink = route('admin.activate.account', ['token' => $this->token]);

        // Pass both the user and the activation link to the view
        return $this->subject('Activate Your Account')
            ->view('emails.activation-link', [
                'activationLink' => $activationLink,
                'user' => $this->user
            ]);
    }
}
