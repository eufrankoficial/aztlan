<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceChartTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_chart_type', function (Blueprint $table) {
            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('device');
            $table->unsignedBigInteger('chart_type_id');
            $table->foreign('chart_type_id')->references('id')->on('chart_type');
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id')->references('id')->on('field');
            $table->tinyInteger('x')->nullable();
            $table->tinyInteger('y')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_chart_type');
    }
}
