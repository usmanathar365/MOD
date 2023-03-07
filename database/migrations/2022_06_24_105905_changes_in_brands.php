<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesInBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
     
     

            $table->string('mail_host')->nullable();
            $table->string('mail_driver')->nullable();
            $table->integer('mail_port')->nullable();
            $table->string('mail_user_name')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_email_address')->nullable();
            $table->string('mail_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('mail_host');
            $table->dropColumn('mail_driver');
            $table->dropColumn('mail_port');
            $table->dropColumn('mail_user_name');
            $table->dropColumn('mail_password');
            $table->dropColumn('mail_encryption');
            $table->dropColumn('mail_email_address');
            $table->dropColumn('mail_name');

        });
    }
}
