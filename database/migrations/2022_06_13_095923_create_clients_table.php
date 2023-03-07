<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->integer('brand_id');
            $table->string('phone');
            $table->string('source');
            $table->string('company');
            $table->string('website');
            $table->string('address');
            $table->string('image');
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('zip');
            $table->string('message');
            $table->string('ip');
            $table->string('package');
            $table->string('created_by');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['Inactive','Active'])->default('Active');
            $table->rememberToken();
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
        Schema::dropIfExists('clients');
    }
}
