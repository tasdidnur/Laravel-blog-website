<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
          $table->bigIncrements('tag_id');
          $table->string('tag_name',100)->unique();
          $table->text('tag_description')->nullable();
          $table->string('tag_slug',30)->nullable();
          $table->integer('tag_status')->default(1);
          $table->integer('tag_creator')->nullable();
          $table->integer('tag_editor')->nullable();
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
        Schema::dropIfExists('tags');
    }
}
