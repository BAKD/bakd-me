<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->enum('type', [
                'INVESTOR',
                'ADVISOR',
                'MENTOR',
                'DEVELOPER',
                'MARKETER',
                'DESIGNER',
                'LAWYER',
                'MANAGEMENT',
                'SOCIAL_MEDIA',
                'CUSTOMER_SUPPORT'
            ])->default('INVESTOR')->after('email_verified_at');
            $table->text('avatar_url')->nullable()->default(null)->after('email_verified_at');
            $table->enum('avatar_type', [
                'GRAVATAR', 
                'UPLOAD', 
                'SOCIAL'
            ])->default('GRAVATAR')->after('email_verified_at');
            $table->string('title')->nullable()->default(null)->after('email_verified_at');
            $table->longText('bio')->nullable()->default(null)->after('email_verified_at');
            $table->text('wallet')->nullable()->default(null)->after('email_verified_at');
            $table->text('website')->nullable()->default(null)->after('email_verified_at');
            $table->unsignedBigInteger('follower_count')->default(0)->after('email_verified_at');
            $table->unsignedBigInteger('following_count')->default(0)->after('email_verified_at');
            $table->boolean('private')->default(false)->after('email_verified_at');
            $table->boolean('verified')->default(false)->after('email_verified_at');
            $table->decimal('balance', 32, 16)->after('email_verified_at');
            $table->unsignedBigInteger('currency_id')->comment('Currency type of user balance.')->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('title');
            $table->dropColumn('bio');
            $table->dropColumn('avatar_url');
            $table->dropColumn('avatar_type');
            $table->dropColumn('wallet');
            $table->dropColumn('website');
            $table->dropColumn('follower_count');
            $table->dropColumn('following_count');
            $table->dropColumn('verified');
            $table->dropColumn('balance');
            $table->dropColumn('private');
            $table->dropColumn('currency_id');
        });        
    }
}
