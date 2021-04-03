<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\TemplateType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TemplateTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //

        Template::create(
            [
                'name'       => 'Header1',
                'content'    => '<mj-section background-color="#efefef" full-width="full-width"><mj-column><mj-text font-size="24px" font-weight="300">Your brand name</mj-text></mj-column></mj-section>',
                'type_id'    => TemplateType::where('name', 'Header')->first()->id,
                'secret_api' => Str::uuid(),
            ]
        );
        Template::create(
            [
                'name'       => 'Footer1',
                'content'    => '<mj-section background-color="#efefef" full-width="full-width"><mj-text>2021 &copy; Your brand name. All right reserved.</mj-text></mj-section>',
                'type_id'    => TemplateType::where('name', 'Footer')->first()->id,
                'secret_api' => Str::uuid(),
            ]
        );
        Template::create(
            [
                'name'       => 'Email1',
                'subject'    => 'Welcome',
                'content'    => '<mj-section background-color="#fff"><mj-column><mj-text align="center"><h2>TchuryMail!</h2></mj-text></mj-column><mj-column><mj-image width="200" src="http://placehold.it/200x200"></mj-image></mj-column></mj-section>',
                'type_id'    => TemplateType::where('name', 'Content')->first()->id,
                'secret_api' => Str::uuid(),
            ]);
    }
}
