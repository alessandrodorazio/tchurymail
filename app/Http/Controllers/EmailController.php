<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Template;
use Exception;
use Illuminate\Http\Request;
use Tchury\Responser\Responser;

class EmailController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function history() {
        //return Email::orderBy('created_at', 'desc')->get();
    }

    public function index() {
        return "WIP";
    }

    public function sendEmail(Request $request, $uuid) {
        //validation rules
        $this->validate($request, ['recipient' => 'required|email']);

        $recipient = $request->recipient;
        $template = Template::where('secret_api', $uuid)->firstOrFail();
        $template_id = $template->id;
        $variables = json_decode($request->variables);

        $email = new Email();
        $email->setRecipient($recipient);
        $email->setTemplateId($template_id);

        try {
            $email->sendEmail($variables);
        } catch( Exception $e ) {
            return $e->getMessage();
        }

        $responser = new Responser();
        $responser->message('Email sent');

        return $responser->response();
    }
    //
}
