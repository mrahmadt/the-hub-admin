<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabs', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->foreignId('tabtype_id')->constrained('tabtypes')->onDelete('cascade');
            $table->text('body')->nullable();
            $table->text('url')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->boolean('activated')->default(true);

            $table->unsignedSmallInteger('itemorder')->default(1);
            $table->timestamps();
        });
$procedure = "
CREATE PROCEDURE `sortTabs`(Tab_id Int, displayNumber int)
BEGIN
UPDATE tabs SET itemorder = displayNumber WHERE id=Tab_id;
SET @step = 0;
UPDATE tabs SET itemorder = IF(@step!=(displayNumber-1), (@step := @step + 1) , (@step := @step + 2)) WHERE id!=Tab_id  ORDER BY itemorder ASC;
END
";

DB::unprepared("DROP procedure IF EXISTS sortTabs");
DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabs');
    }
}
