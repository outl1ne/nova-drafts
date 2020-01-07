<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class :className extends Migration
{
    public static $userTable = ':table';
    public static $uniqueField = ':unique';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($userTable, function ($table) use ($userTable, $uniqueField) {
            $table->string('preview_token')->nullable();
            $table->boolean('published')->default(true);
            $table->bigInteger('draft_parent_id')->nullable()->unsigned();
            $table->foreign('draft_parent_id')->references('id')->on($userTable)->onDelete('cascade');
            $table->unique([$uniqueField, 'published'], "{$userTable}_{$uniqueField}_published_unique");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($userTable, function ($table) use ($userTable, $uniqueField) {
            $table->dropForeign($userTable . '_draft_parent_id_foreign');
            $table->dropColumn('draft_parent_id');
            $table->dropColumn('published');
            $table->dropColumn('preview_token');
            $table->dropUnique("{$userTable}_{$uniqueField}_published_unique");
        });
    }
}
