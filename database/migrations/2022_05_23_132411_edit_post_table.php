<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditPostTable extends Migration
{
    /**
     * migration for add new column without refreshing
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('posts', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id')
                ->nullable()
                ->after('user_id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('SET NULL');

        });

        Schema::disableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            // $table->dropColumn('category_id');
        });

        Schema::disableForeignKeyConstraints();
    }
}
