<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableColumnsToClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('first_name')->unsigned()->nullable()->change();
            $table->string('last_name')->unsigned()->nullable()->change();
            $table->integer('brand_id')->unsigned()->nullable()->change();
            $table->string('phone')->unsigned()->nullable()->change();
            $table->string('source')->unsigned()->nullable()->change();
            $table->string('company')->unsigned()->nullable()->change();
            $table->string('website')->unsigned()->nullable()->change();
            $table->string('address')->unsigned()->nullable()->change();
            $table->string('image')->unsigned()->nullable()->change();
            $table->string('city')->unsigned()->nullable()->change();
            $table->string('country')->unsigned()->nullable()->change();
            $table->string('state')->unsigned()->nullable()->change();
            $table->string('zip')->unsigned()->nullable()->change();
            $table->string('message')->unsigned()->nullable()->change();
            $table->string('ip')->unsigned()->nullable()->change();
            $table->string('package')->unsigned()->nullable()->change();
            $table->string('created_by')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('first_name')->unsigned(false)->nullable()->change();
            $table->string('last_name')->unsigned(false)->nullable()->change();
            $table->integer('brand_id')->unsigned(false)->nullable()->change();
            $table->string('phone')->unsigned(false)->nullable()->change();
            $table->string('source')->unsigned(false)->nullable()->change();
            $table->string('company')->unsigned(false)->nullable()->change();
            $table->string('website')->unsigned(false)->nullable()->change();
            $table->string('address')->unsigned(false)->nullable()->change();
            $table->string('image')->unsigned(false)->nullable()->change();
            $table->string('city')->unsigned(false)->nullable()->change();
            $table->string('country')->unsigned(false)->nullable()->change();
            $table->string('state')->unsigned(false)->nullable()->change();
            $table->string('zip')->unsigned(false)->nullable()->change();
            $table->string('message')->unsigned(false)->nullable()->change();
            $table->string('ip')->unsigned(false)->nullable()->change();
            $table->string('package')->unsigned(false)->nullable()->change();
            $table->string('created_by')->unsigned(false)->nullable()->change();
        });
    }
}
