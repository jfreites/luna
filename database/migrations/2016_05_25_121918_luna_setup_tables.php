<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LunaSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('order');
            $table->boolean('private')->default(0);
            $table->boolean('is_home')->default(0);
            $table->boolean('visible_in_menu')->default(0);
            $table->string('slug')->nullable();
            $table->string('title');
            $table->text('body');
            $table->boolean('status')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('template');
            $table->boolean('no_cache')->default(0);
            $table->text('css')->nullable();
            $table->text('js')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('file_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('original_filename');
            $table->string('path');
            $table->string('mime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
        Schema::drop('file_entries');
    }
}