<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsToNullableInBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('logo')->unsigned()->nullable()->change();
            $table->string('name')->unsigned()->nullable()->change();
            $table->string('email')->unsigned()->nullable()->change();
            $table->string('link')->unsigned()->nullable()->change();
            $table->string('address')->unsigned()->nullable()->change();
            $table->string('phone')->unsigned()->nullable()->change();           
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
            $table->string('logo')->unsigned()->nullable(false)->change();
            $table->string('name')->unsigned()->nullable(false)->change();
            $table->string('email')->unsigned()->nullable(false)->change();
            $table->string('link')->unsigned()->nullable(false)->change();
            $table->string('address')->unsigned()->nullable(false)->change();
            $table->string('phone')->unsigned()->nullable(false)->change();
        });
    }
}



// Schema::table('employees', function (Blueprint $table) {
//     $table->renameColumn('emp_name', 'employee_name');// Renaming "emp_name" to "employee_name"
//     $table->string('gender',10)->change(); // Change Datatype length
//     $table->dropColumn('active'); // Remove "active" field
//     $table->smallInteger('status')->after('email'); // Add "status" column
// });

// Here, I did the following changes –
// Rename emp_name column name to employee_name.
// Changed gender column Datatype length.
// Delete active column.
// Add a new status column.
// In down() method –
