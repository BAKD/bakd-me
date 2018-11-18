<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->boolean('is_reply')->default(false)->after('message');
            $table->unsignedBigInteger('parent_id')->nullable()->default(null)->after('message');
            $table->unsignedBigInteger('likes')->default(0)->after('message');
            $table->unsignedBigInteger('dislikes')->default(0)->after('message');
            $table->unsignedBigInteger('upvotes')->default(0)->after('message');
            $table->unsignedBigInteger('downvotes')->default(0)->after('message');
            $table->unsignedBigInteger('views')->default(0)->after('message');
            $table->unsignedBigInteger('interactions')->default(0)->after('message');
            $table->unsignedBigInteger('comments')->default(0)->after('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->dropColumn('is_reply');
            $table->dropColumn('parent_id');
            $table->dropColumn('likes');
            $table->dropColumn('dislikes');
            $table->dropColumn('upvotes');
            $table->dropColumn('downvotes');
            $table->dropColumn('views');
            $table->dropColumn('interactions');
            $table->dropColumn('comments');
        });
    }
}
