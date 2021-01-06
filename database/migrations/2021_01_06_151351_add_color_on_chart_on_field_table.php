<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorOnChartOnFieldTable extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field', function (Blueprint $table) {
            $table->string('color_on_chart')
                    ->after('show_on_chart')
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
            $table->dropColumn('color_on_chart');
        });
    }
}
