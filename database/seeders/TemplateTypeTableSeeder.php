<?php

namespace Database\Seeders;

use App\Models\TemplateType;
use Illuminate\Database\Seeder;

class TemplateTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TemplateType::create(['name' => 'Header']);
        TemplateType::create(['name' => 'Footer']);
        TemplateType::create(['name' => 'Content']);
    }
}
