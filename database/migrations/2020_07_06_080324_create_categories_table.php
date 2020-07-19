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
            $table->id();
            $table->string('name',100);
            $table->boolean('activated')->default(true);
            $table->unsignedSmallInteger('itemorder')->default(1);
            $table->timestamps();
        });

$procedure = "
CREATE PROCEDURE `sortcategories`(Category_id Int, displayNumber int)
BEGIN
UPDATE categories SET itemorder = displayNumber WHERE id=Category_id;
SET @step = 0;
UPDATE categories SET itemorder = IF(@step!=(displayNumber-1), (@step := @step + 1) , (@step := @step + 2)) WHERE id!=Category_id  ORDER BY itemorder ASC;
END
";

DB::unprepared("DROP procedure IF EXISTS sortcategories");
DB::unprepared($procedure);

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
