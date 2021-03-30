<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Template;
use Exception;
use Illuminate\Http\Request;
use Tchury\Responser\Responser;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function history()
    {
        //return Email::orderBy('created_at', 'desc')->get();
    }

    public function index() {
        return "ciao";
    }

    public function sendEmail(Request $request, $uuid)
    {
        //validation rules
        $this->validate($request, [
            'recipient' => 'required|email'
        ]);

        //TODO check if it is a content, not header or footer
        $recipient = $request->recipient;
        $template = Template::where('secret_api', $uuid)->firstOrFail();
        if($template->category->name === "Header" || $template->category->name === "Footer") {
            $responser = new Responser();
            $responser->statusCode(500);
            $responser->message('You cannot send an header or a footer');
            return $responser->response();
        }
        $template_id = $template->id;
        $variables = json_decode($request->variables);

        $email = new Email();
        $email->setRecipient($recipient);
        $email->setTemplateId($template_id);

        try {
            $email->sendEmail($variables);
        } catch(Exception $e) {
            return $e;
        }


        $responser = new Responser();
        $responser->message('Email sent');
        return $responser->response();

    }

    //
}
