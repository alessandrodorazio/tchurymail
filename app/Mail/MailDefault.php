<?php

    namespace App\Mail;

    use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;

    class MailDefault extends Mailable {
        use Queueable, SerializesModels;

        public $content, $subject;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct ($subject, $content) {
            //
            $this->subject;
            $this->content = $content;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build () {
            return $this->subject ($this->subject)
                        ->mjml ('mail.default', ['content' => $this->content]);
        }
    }
