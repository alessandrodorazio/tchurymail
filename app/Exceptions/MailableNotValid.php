<?php

namespace App\Exceptions;

use Exception;
use Tchury\Responser\Responser;

class MailableNotValid extends Exception {
    //
    /**
     * @return mixed
     */
    public $message = 'Mailable not valid.';

    public function render($request) {
        $responser = new Responser();
        $responser->failed();
        $responser->message($this->getMessage());
        $responser->statusCode(500);

        return $responser->response();
    }
}
