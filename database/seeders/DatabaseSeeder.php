<?php

use App\Models\User;
use Database\Seeders\TemplateTableSeeder;
use Database\Seeders\TemplateTypeTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call('UsersTableSeeder');
        \App\Models\Layout::create([
                                       'name'   => 'Default layout',
                                       'header' => '<mj-section background-color="#efefef" full-width="full-width"><mj-column><mj-text font-size="24px" font-weight="300">Your brand name</mj-text></mj-column></mj-section>',
                                       'footer' => '<mj-section background-color="#efefef" full-width="full-width"><mj-text>2021 &copy; Your brand name. All right reserved.</mj-text></mj-section>',
                                   ]);
        $this->call(TemplateTableSeeder::class);
        $user = User::create([
                                 'name'      => 'Admin',
                                 'email'     => 'admin@admin.com',
                                 'password'  => Hash::make('password'),
                                 'api_token' => Str::random(60),
                             ]);
        shell_exec('php artisan orchid:admin --id=1');
    }
}
