<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('device');
            $table->text('description')->nullable();
            $table->string('lon', 100)->nullable();
            $table->string('lat', 100)->nullable();
            $table->decimal('bat',  8, 2)->nullable();
            $table->decimal('temp', 8, 2)->nullable();
            $table->decimal('umi', 8, 2)->nullable();
            $table->boolean('cnt')->nullable();
            $table->string('co2', 50)->nullable();
            $table->decimal('tempdht1', 8, 2)->nullable();
            $table->decimal('tempdht2', 8, 2)->nullable();
            $table->decimal('umidht1', 8, 2)->nullable();
            $table->decimal('umidht2', 8, 2)->nullable();
            $table->timestamp('stamp')->nullable()->default(now());
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_detail');
    }
}
