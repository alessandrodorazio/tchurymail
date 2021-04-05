<?php

namespace App\Models;

use App\Mail\MailDefault;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use ReflectionObject;

class Email extends Model {
    use AsSource, Filterable;

    protected $table = 'email_history';
    protected $fillable = [
        'recipient',
        'template_id',
    ];
    protected $allowedSorts = [
        'recipient',
        'created_at',
    ];
    protected $hidden = [];

    public function setRecipient($recipient) {
        $this->recipient = $recipient;
    }

    public function setTemplateId($templateId) {
        $this->template_id = $templateId;
    }

    public function template() {
        return $this->belongsTo(Template::class, 'template_id', 'id');
    }

    public function sendEmail($variables) {
        $content = $this->constructEmailContent($variables);
        $attachments = $this->template->attachments()->get();

        Mail::to($this->recipient)->send(new MailDefault($this->template->subject, $content, $attachments));
        $this->save();
    }

    public function constructEmailContent($variables, $options = []) {
        if( $variables === null ) {
            throw new Exception('Variables not found');
        }

        $header = $this->template->header;
        $footer = $this->template->footer;
        $content =
            '<mjml><mj-head>' . $this->template->head . '</mj-head><mj-body background-color="#eee">' .
            $header->content . $this->template->content . $footer->content . '</mj-body></mjml>';

        return self::replaceVariablesWithContent($content, $variables, $options);
    }

    public static function replaceVariablesWithContent($content, $variables, $options) {
        if( array_key_exists("preview", $options) ) {
            $content =
                str_replace('{{$', '<span style="background-color: #007bff; color: white; padding: 3px;">', $content);
            $content = str_replace('}}', '</span>', $content);
        }
        $ref = new ReflectionObject($variables);
        foreach( $ref->getProperties() as $prop ) {
            $content = str_replace('{{$' . $prop->getName() . '}}', $prop->getValue($variables), $content);
        }

        return $content;
    }
}
