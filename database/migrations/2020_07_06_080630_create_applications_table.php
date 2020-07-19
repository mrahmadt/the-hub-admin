<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();


            $table->string('name',100);
            $table->text('url');
            $table->text('icon')->nullable();
            $table->text('description')->nullable();

            //Web Browser (default)
            $table->boolean('isNewPage')->default(false);
            $table->boolean('isNewPageForIframe')->default(false);

            $table->boolean('activated')->default(true);
            $table->boolean('isFeatured')->default(false);

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
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
        Schema::dropIfExists('applications');
    }
}
