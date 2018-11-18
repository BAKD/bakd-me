<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid'); 
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('organization_id');
            $table->string('position', 250)->nullable()->default(null)->comment('What position does this person hold in the organization?');
            $table->boolean('owner')->default(false)->comment('Is this the owner of the organization?');
            $table->boolean('private')->default(false)->comment('Hide the fact this user is a part of the organization?');
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
        Schema::dropIfExists('organization_user');
    }
}
