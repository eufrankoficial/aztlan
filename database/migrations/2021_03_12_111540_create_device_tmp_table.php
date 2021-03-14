<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTmpTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('device_tmp', function (Blueprint $table) {
            $table->id();
            $table->string('device_code', 255);
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('device_tmp');
    }
}
