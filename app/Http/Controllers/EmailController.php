<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
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

    public function index()
    {
        return "WIP";
    }

    public function sendEmail(Request $request, $uuid)
    {
        //validation rules
        $this->validate($request, ['recipient' => 'required|email']);
        if ($request->secret !== config('app.mail_api_secret')) {
            return;
        }
        $recipient = $request->recipient;
        $template = Template::where('secret_api', $uuid)->firstOrFail();
        $template_id = $template->id;
        if ($request->variables) {
            $variables = json_decode($request->variables);
        } else {
            $variables = (object) [];
        }

        Queue::push(new SendMailJob($recipient, $template_id, $variables));

        $responser = new Responser();
        $responser->success()->message('Email dispatched');

        return $responser->response();
    }
    //
}
