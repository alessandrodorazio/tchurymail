<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\TemplateType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Template::create(
            [
                'name' => 'Email1',
                'content' => '<mj-section background-color="#fff"><mj-column><mj-text align="center"><h2>MJML Rockss!</h2></mj-text></mj-column><mj-column><mj-image width="200" src="http://placehold.it/200x200"></mj-image></mj-column></mj-section>',
                'type_id' => TemplateType::where('name', 'Content')->first()->id,
                'secret_api' => Str::uuid()
            ]);
        Template::create(
            [
                'name' => 'Header1',
                'content'=>'<mj-section><mj-column><mj-text>This is the header </mj-text></mj-column></mj-section>',
                'type_id' => TemplateType::where('name', 'Header')->first()->id,
                'secret_api' => Str::uuid()
            ]
        );
        Template::create(
            [
                'name' => 'Footer1',
                'content'=>'<mj-section><mj-column><mj-text>This is the footer </mj-text></mj-column></mj-section>',
                'type_id' => TemplateType::where('name', 'Footer')->first()->id,
                'secret_api' => Str::uuid()
            ]
        );
    }
}
