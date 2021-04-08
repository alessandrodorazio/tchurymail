<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('templates', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject')->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('layout_id')->unsigned()->nullable();
            $table->string('secret_api')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('template_categories')->nullOnDelete();
            $table->foreign('layout_id')->references('id')->on('layouts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('templates');
    }
}
