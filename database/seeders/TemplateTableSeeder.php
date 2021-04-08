<?php

namespace Database\Seeders;

use App\Models\Layout;
use App\Models\Template;
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
                'name'      => 'Email1',
                'layout_id' => Layout::first()->id,

                'subject'    => 'Welcome',
                'content'    => '<mj-section background-color="#fff"><mj-column><mj-text align="center"><h2>TchuryMail!</h2></mj-text></mj-column><mj-column><mj-image width="200" src="http://placehold.it/200x200"></mj-image></mj-column></mj-section>',
                'secret_api' => Str::uuid(),
            ]);
    }
}
