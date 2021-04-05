<?php

namespace Tests\Feature\Template;

use Tests\TestCase;

class TemplateCategoryTest extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
