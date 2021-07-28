<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('firstname')->nullable()->after("id");
            $table->string('lastname')->nullable()->after("firstname");
            $table->date('DOB')->nullable()->after("lastname");
            $table->string('phone')->nullable()->after("DOB");
     //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $$table->string("name");
            $table->dropColumn(['firstname', 'lastname', 'DOB', 'phone']);

        });
    }
}
