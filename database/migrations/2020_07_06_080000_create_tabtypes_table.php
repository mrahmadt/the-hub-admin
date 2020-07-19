<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabtypes', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->boolean('body_required');
            $table->boolean('url_required');
            $table->boolean('category_required');

            $table->integer('action')->default(1); //0=>all apps, 1=>body , 2=>url, 3=>category
            $table->boolean('url_iframe')->default(0);

            /*
            1=>all apps -> Ajax
            2=>category -> Ajax
            3=>html 
            4=>link
            5=>iframe -> Link
            6=>Teams deeplink ->link
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabtypes');
    }
}
