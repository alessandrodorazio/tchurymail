<?php

namespace Tests\Feature\Email;

use Tests\TestCase;

class Email extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSend() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
