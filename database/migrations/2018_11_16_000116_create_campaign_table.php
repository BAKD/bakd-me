<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->comment('Creator of the campaign.');
            $table->unsignedBigInteger('organization_id')->comment('Organization running the campaign.');
            $table->unsignedBigInteger('currency_id')->comment('Currency type for the requested Goal Amount.');
            $table->decimal('goal_min', 32, 16)->default(0)->comment('Fundign goal soft cap.');
            $table->decimal('goal_max', 32, 16)->default(0)->comment('Fundign goal min cap.');
            $table->string('title')->nullable()->default(null)->comment('Campaign title.');
            $table->string('subtitle')->nullable()->default(null)->comment('Campaign subtitle.');
            $table->longText('description')->nullable()->default(null)->comment('Campaign description.');
            $table->boolean('verified')->default(0)->comment('Campaign verification/vetted status.');
            $table->timestamp('start_date')->nullable()->default(null)->comment('Campaign title.');
            $table->timestamp('end_date')->nullable()->default(null)->comment('Campaign title.');
            $table->softDeletes();
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
        Schema::dropIfExists('campaign');
    }
}
