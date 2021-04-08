<?php

namespace App\Mail;

use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class MailDefault extends Mailable {
    use Queueable, SerializesModels;

    public $content, $subject, $attachmentsList;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $content, $attachments = []) {
        //
        $this->subject;
        if( env('APP_DEBUG') === true ) {
            $this->subject = "DEBUG MAIL: " . $this->subject;
        }
        $this->content = $content;
        $this->attachmentsList = $attachments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $mail = $this->subject($this->subject)
                     ->mjml('mail.default', ['content' => $this->content]);
        foreach( $this->attachmentsList as $attachment ) {
            $mail->attachFromStorage('/public/' . $attachment->path . $attachment->name . '.' .
                                     $attachment->extension, $attachment->original_name);
        }

        return $mail;
    }
}
