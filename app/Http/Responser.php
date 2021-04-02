<?php

    namespace App\Http;

    class Responser {
        public $response = ['responseMessage' => '',];

        public $statusCode = 200;

        public function returnResponse () {
            return response ()->json ($this->response, $this->statusCode)->send ();
        }

        public function customResponseMessage ($responseMessage) {
            $this->response['responseMessage'] = $responseMessage;
            return $this;
        }

        public function addItemToResponse ($itemName, $itemValue) {
            $this->response = (object)array_merge ((array)$this->response, [$itemName => $itemValue]);
            return $this;
        }

        public function customStatusCode ($statusCode) {
            $this->statusCode = $statusCode;
            return $this;
        }
    }
