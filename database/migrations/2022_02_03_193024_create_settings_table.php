<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('setting_id');
            $table->string('light_logo',60)->nullable();
            $table->string('dark_logo',60)->nullable();
            $table->string('facebook',70)->nullable();
            $table->string('twitter',70)->nullable();
            $table->string('instagram',70)->nullable();
            $table->string('youtube',70)->nullable();
            $table->string('pinterest',70)->nullable();
            $table->string('linkedin',70)->nullable();
            $table->string('copyright',90)->nullable();
            $table->integer('editor')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
