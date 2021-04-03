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
    public function up () {
        Schema::create ('templates', function (Blueprint $table) {
            $table->id ();
            $table->string ('name');
            $table->string ('subject')->nullable ();
            $table->longText ('head')->nullable ();
            $table->longText ('content');
            $table->bigInteger ('category_id')->unsigned ()->nullable ();
            $table->bigInteger ('type_id')->unsigned ()->nullable ();
            $table->bigInteger ('header_id')->unsigned ()->nullable ();
            $table->bigInteger ('footer_id')->unsigned ()->nullable ();
            $table->string ('secret_api')->nullable ();
            $table->timestamps ();

            $table->foreign ('category_id')->references ('id')->on ('template_categories')->nullOnDelete ();
            $table->foreign ('type_id')->references ('id')->on ('template_types')->nullOnDelete ();
            $table->foreign ('header_id')->references ('id')->on ('templates')->nullOnDelete ();
            $table->foreign ('footer_id')->references ('id')->on ('templates')->nullOnDelete ();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists ('email_layout');
    }
}
