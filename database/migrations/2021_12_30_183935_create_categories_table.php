<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
          $table->bigIncrements('cat_id');
          $table->string('cat_name',100)->unique();
          $table->text('cat_description')->nullable();
          $table->string('cat_slug',30)->nullable();
          $table->integer('cat_status')->default(1);
          $table->integer('cat_creator')->nullable();
          $table->integer('cat_editor')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
