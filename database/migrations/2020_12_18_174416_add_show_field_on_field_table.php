<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowFieldOnFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field', function (Blueprint $table) {
            $table->tinyInteger('show_on_list')->after('form_name')->default(1);
            $table->tinyInteger('show_on_form')->after('form_name')->default(1);
            $table->tinyInteger('show_on_report')->after('form_name')->default(1);
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
            $table->dropColumn('show_on_list');
            $table->dropColumn('show_on_form');
            $table->dropColumn('show_on_report');
        });
    }
}
