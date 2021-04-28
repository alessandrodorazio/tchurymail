<?php

namespace App\Jobs;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $recipient, $template_id, $variables;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient, $template_id, $variables)
    {
        $this->recipient   = $recipient;
        $this->template_id = $template_id;
        $this->variables   = $variables;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new Email();
        $email->setRecipient($this->recipient);
        $email->setTemplateId($this->template_id);
        
        $email->sendEmail($this->variables);
    }
}
