<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Welcome to Our Service';
        $view = 'emails.welcome_' . strtolower(str_replace(' ', '_', $this->subscription->type));

        return $this->subject($subject)
                    ->view($view)
                    ->with([
                        'subscription' => $this->subscription,
                    ]);
    }
}
