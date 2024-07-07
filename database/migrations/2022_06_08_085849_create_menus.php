<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('header')->nullable();
            $table->integer('menu_id')->nullable();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('link')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes(); 
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
