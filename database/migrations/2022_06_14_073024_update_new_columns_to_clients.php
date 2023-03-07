<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNewColumnsToClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->json('additional_json')->nullable();            
            $table->string('region')->nullable();
            $table->string('loc')->nullable();
            $table->string('timezone')->nullable();
            $table->string('postal')->nullable();
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
            $table->dropColumn('additional_json');
            $table->dropColumn('region');
            $table->dropColumn('loc');
            $table->dropColumn('timezone');
            $table->dropColumn('postal');
        });
    }
}
