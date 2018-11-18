<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id')->comment('ID field of the owner type\'s table row.');
            $table->enum('owner_type', ['USER', 'ORGANIZATION', 'CAMPAIGN'])->default('USER');
            $table->text('facebook')->nullable()->default(null);
            $table->text('linkedin')->nullable()->default(null);
            $table->text('twitter')->nullable()->default(null);
            $table->text('google')->nullable()->default(null);
            $table->text('github')->nullable()->default(null);
            $table->text('discord')->nullable()->default(null);
            $table->text('telegram')->nullable()->default(null);
            $table->text('medium')->nullable()->default(null);
            $table->text('steemit')->nullable()->default(null);
            $table->text('bitcoin')->nullable()->default(null);
            $table->text('reddit')->nullable()->default(null);
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
        Schema::dropIfExists('social');
    }
}
