<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('invoice_number')->nullable();
            $table->integer('reference')->nullable();
            $table->timestamp('issue_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->decimal('subtotal_amount', 12, 2)->nullable();
            $table->decimal('total_tax', 12, 2)->nullable();
            $table->decimal('total_discount', 12, 2)->nullable();
            $table->decimal('total_amount', 12, 2)->nullable();
            $table->decimal('total_amount_paid', 12, 2)->nullable();
            $table->decimal('partial_payments', 12, 2)->nullable();
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
        

    }
}
