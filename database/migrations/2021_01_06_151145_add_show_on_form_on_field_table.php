<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowOnFormOnFieldTable extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field', function (Blueprint $table) {
            $table->integer('show_on_chart')
                    ->after('show_on_list')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('field', function (Blueprint $table) {
            $table->dropColumn('show_on_chart');
        });
    }
}
