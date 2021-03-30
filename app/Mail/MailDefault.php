<?php

namespace App\Mail;

use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class MailDefault extends Mailable
{
    use Queueable, SerializesModels;
    public $content, $header, $footer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        //
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("TEST MICROSERVIZIO MAILER: COLLABORAZIONI?")->mjml('mail.default', ['content' => $this->content]);
    }
}
