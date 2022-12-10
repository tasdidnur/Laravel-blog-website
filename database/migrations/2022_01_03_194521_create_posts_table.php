<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
          $table->bigIncrements('post_id');
          $table->string('post_title',100)->unique();
          $table->longText('post_description')->nullable();
          $table->string('post_image',50)->nullable();
          $table->string('post_slug',100)->nullable();
          $table->integer('cat_id')->nullable();
          $table->integer('post_status')->default(1);
          $table->integer('approve_status')->default(0);
          $table->integer('view_count')->default(0);
          $table->integer('post_creator')->nullable();
          $table->integer('post_editor')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
