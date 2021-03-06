<?php

namespace Tests\Feature\Template;

use Tests\TestCase;

class TemplateTest extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewTemplate(): string {
        $templateName = 'TestTemplate' . \Illuminate\Support\Str::random();
        $template = new \App\Models\Template;
        $template->name = $templateName;
        $template->save();
        $template = \App\Models\Template::where('name', $templateName)->first();
        $this->assertNotNull($template);

        return $templateName;
    }

    /**
     * @depends testNewTemplate
     **/
    public function testDeleteTemplate($templateName) {
        $template = \App\Models\Template::where('name', $templateName)->first();
        $this->assertNotNull($templateName);
        $template->delete();
        $template = \App\Models\Template::where('name', $templateName)->first();
        $this->assertNull($template);
    }
}
