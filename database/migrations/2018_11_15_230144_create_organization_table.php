<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid'); 
            $table->text('name');
            $table->text('logo')->nullable()->comment('URL or path to company logo.');
            $table->text('website')->nullable()->default(null);
            $table->longText('description', 5000);
            $table->unsignedInteger('year_founded')->nullable()->default(null);
            $table->unsignedInteger('employee_count')->nullable()->default(1);
            $table->string('wallet', 100)->nullable()->default(null)->comment('BTC Wallet Address. Soon to be a BAKD Address.');
            $table->string('email', 200)->nullable()->default(null)->comment('Organization help/support email.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization');
    }
}
