<?php

use App\Models\User;
use Database\Seeders\TemplateTableSeeder;
use Database\Seeders\TemplateTypeTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call(TemplateTypeTableSeeder::class);
        $this->call(TemplateTableSeeder::class);
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60)
        ]);
        shell_exec('php artisan orchid:admin --id=1');
    }
}
