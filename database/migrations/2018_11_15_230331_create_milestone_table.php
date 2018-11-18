<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid'); 
            $table->string('name', 250);
            $table->longText('description')->nullable()->default(null);
            $table->enum('type', ['initial', 'regular', 'final']);
            $table->timestamp('tentative_date');
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
        Schema::dropIfExists('milestone');
    }
}
