<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValuesToPaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_methods', function (Blueprint $table) {

            $table->string('name')->unsigned()->nullable()->change();
            $table->string('public_key')->unsigned()->nullable()->change();
            $table->string('private_key')->unsigned()->nullable()->change();
            $table->string('extra_key_1')->unsigned()->nullable()->change();
            $table->string('extra_key_2')->unsigned()->nullable()->change();
            $table->string('extra_json')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_methods', function (Blueprint $table) {


            $table->string('name')->unsigned()->nullable(false)->change();
            $table->string('public_key')->unsigned()->nullable(false)->change();
            $table->string('private_key')->unsigned()->nullable(false)->change();
            $table->string('extra_key_1')->unsigned()->nullable(false)->change();
            $table->string('extra_key_2')->unsigned()->nullable(false)->change();
            $table->string('extra_json')->unsigned()->nullable(false)->change();
        });
    }
}
