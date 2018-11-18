<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->enum('type', [
                'credit', 'debit', 'deposit', 'disbursement', 'refund', 'transfer', 'none'
            ])->default('none');
            $table->json('payload')->nullable()->default(null)->comment('Any extra data related to the transaction.');
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
        Schema::dropIfExists('transaction');
    }
}
